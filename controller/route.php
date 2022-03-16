<?php

include '../koneksi.php';
require_once '../model/login.php';
// Administrasi
require_once '../model/add_user.php';
require_once '../model/update_user.php';
require_once '../model/delete_user.php';
// Event
require_once '../model/add_event.php';
require_once '../model/update_event.php';
require_once '../model/delete_event.php';

$data = $_REQUEST;

switch($data['aksi']){

    case 'login':
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = login($email, $password);
        $decode = json_decode($query);
        
        //  Jika inputan benar
        if($decode->id != 'FALSE' && $decode->id != NULL){
            session_start();
            session_regenerate_id(true);
            $_SESSION['id'] = $decode->id;
            $_SESSION['nama'] = $decode->nama;
            $_SESSION['email'] = $decode->email;
            $_SESSION['super'] = $decode->super;
            header("Location: ../view/admin/index?pesan=sukses");
            // Jika inputan salah
        }else if($decode->id == 'FALSE'){
            header("Location: ../view/login?pesan=salah");
            // Jika data tidak ditemukan
        }else if($decode->id == NULL){
            header("Location: ../view/login?pesan=not_found");
        }
    break;

    case 'logout':
        if($_POST['logout']){
            unset($_SESSION['id']);
            unset($_SESSION['nama']);
            unset($_SESSION['email']);
            unset($_SESSION['super']);
            session_unset();
            session_destroy();
            header("Location: ../view/login?pesan=logout");
        }
    break;
    
    // Administrasi
    case 'add_user':
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $super = $_POST['super'];
        $query = add_user($nama, $email, $password, $super);
        if($query == 'true'){
            header("Location: ../admin/views/index?pesan=sukses");
        }else if($query == 'false'){
            header("Location: ../admin/views/index?pesan=gagal");
        }else{
            echo "Error";
        }
    break;
    case 'update_user':
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $super = $_POST['super'];
        // Query
        $query = update_user($id, $nama, $email, $password, $super);
        if($query == 'true'){
            header("Location: ../admin/views/index?pesan=sukses");
        }else if($query == 'false'){
            header("Location: ../admin/views/index?pesan=gagal");
        }else{
            echo "Error";
        }
    break;
    case 'delete_user':
        $id = $_POST['id'];
        $query = delete_user($id);
        if($query == 'true'){
            header("Location: ../admin/views/index?pesan=sukses");
        }else if($query == 'false'){
            header("Location: ../admin/views/index?pesan=gagal");
        }else{
            echo "Error";
        }
    break;

    // Event
    case 'add_event':
        $nama_event = $_POST['nama_event'];
        $tempat = $_POST['tempat'];
        $tanggal_post = date("Y-m-d");
        $tanggal = $_POST['tanggal'];
        $deskripsi = $_POST['deskripsi'];
        $kategori = $_POST['kategori'];
        // Upload gambar
        if(isset($_FILES["files"]) && !empty($_FILES["files"]["name"])){
            foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                $file_name = $key.$_FILES['files']['name'][$key];
                $file_size =$_FILES['files']['size'][$key];
                $file_tmp =$_FILES['files']['tmp_name'][$key];
                $file_type=$_FILES['files']['type'][$key];
                $original_filename = $_FILES['files']['name'][$key];
                $ext = strtolower(pathinfo($_FILES["files"]["name"][$key], PATHINFO_EXTENSION));
                if(in_array( $ext, array('jpg', 'jpeg', 'png', 'gif', 'bmp'))) {
                    $gambar = uniqid() . '.' . $ext;
                    move_uploaded_file($file_tmp,'../assets/upload_images/event/'.$gambar);
                }
            }
        }
        $query = add_event($nama_event, $tempat, $tanggal_post, $tanggal, $deskripsi, $gambar, $kategori);
        if($query == 'true'){
            header("Location: ../admin/views/index?pesan=sukses");
        }else if($query == 'false'){
            header("Location: ../admin/views/index?pesan=gagal");
        }else{
            echo "Error";
        }
    break;
    case 'update_event':
        $id = $_POST['id'];
        $nama_event = $_POST['nama_event'];
        $tempat = $_POST['tempat'];
        $tanggal = $_POST['tanggal'];
        $deskripsi = $_POST['deskripsi'];
        $kategori = $_POST['kategori'];
        $gambar_lama = $_POST['gambar_lama'];
        // Upload gambar
        if(isset($_FILES["files"]) && !empty($_FILES["files"]["name"])){
            $filename = '../assets/upload_images/event/'.$gambar_lama;
            if(file_exists($filename)){
                unlink($filename);
            }
            foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                $file_name = $key.$_FILES['files']['name'][$key];
                $file_size =$_FILES['files']['size'][$key];
                $file_tmp =$_FILES['files']['tmp_name'][$key];
                $file_type=$_FILES['files']['type'][$key];
                $original_filename = $_FILES['files']['name'][$key];
                $ext = strtolower(pathinfo($_FILES["files"]["name"][$key], PATHINFO_EXTENSION));
                if(in_array( $ext, array('jpg', 'jpeg', 'png', 'gif', 'bmp'))) {
                    $gambar = uniqid() . '.' . $ext;
                    move_uploaded_file($file_tmp,'../assets/upload_images/event/'.$gambar);
                }
            }
            $query = update_event($id, $nama_event, $tempat, $tanggal, $deskripsi, $kategori, $gambar);
            if($query == 'true'){
                header("Location: ../admin/views/index?pesan=sukses");
            }else if($query == 'false'){
                header("Location: ../admin/views/index?pesan=gagal");
            }else{
                echo "Error";
            }
        }else{
            $gambar = 'nodata';
            $query = update_event($id, $nama_event, $tempat, $tanggal, $deskripsi, $kategori, $gambar);
            if($query == 'true'){
                header("Location: ../admin/views/index?pesan=sukses");
            }else if($query == 'false'){
                header("Location: ../admin/views/index?pesan=gagal");
            }else{
                echo "Error";
            }
        }
    break;
    case 'delete_event':
        $id = $_POST['id'];
        $gambar_lama = $_POST['gambar_lama'];
        $filename = '../assets/upload_images/event/'.$gambar_lama;
        if(file_exists($filename)){
            unlink($filename);
        }
        $query = delete_event($id);
        if($query == 'true'){
            header("Location: ../admin/views/index?pesan=sukses");
        }else if($query == 'false'){
            header("Location: ../admin/views/index?pesan=gagal");
        }else{
            echo "Error";
        }
    break;

    /* add_campaign disini, mirip versi event, nanti ubah variabel e sesuai kebutuhan field e dan nama kolom di 
    mysql *kecuali id, karena dia auto increment */
    // Campaign
    case 'add_campaign':
    break;
    case 'update_campaign':
    break;
    case 'delete_campaign':
    break;
}

?>