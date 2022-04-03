<?php

include '../koneksi.php';

// Login
require_once '../model/login.php';
// Administrasi
require_once '../model/user.php';
// Event
require_once '../model/event.php';
// Campaign
require_once '../model/campaign.php';
// Kritik & Saran
require_once '../model/suggestion.php';

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
            // Legacy untuk compatibility PHP lama
            session_start();
            $_SESSION = array();
            // Session kill
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            // Session unset
            unset($_SESSION['id']);
            unset($_SESSION['nama']);
            unset($_SESSION['email']);
            unset($_SESSION['super']);
            session_unset();
            // Session destroy
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

    // Campaign
    case 'add_campaign':
        $nama_event = $_POST['nama_campaign'];
        $tanggal_post = date("Y-m-d");
        $deskripsi = $_POST['deskripsi'];
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
                    move_uploaded_file($file_tmp,'../assets/upload_images/campaign/'.$gambar);
                }
            }
        }
        $query = add_campaign($nama_campaign, $tanggal_post, $deskripsi, $gambar);
        if($query == 'true'){
            header("Location: ../admin/views/index?pesan=sukses");
        }else if($query == 'false'){
            header("Location: ../admin/views/index?pesan=gagal");
        }else{
            echo "Error";
        }
    break;
    case 'update_campaign':
        $id = $_POST['id'];
        $nama_campaign = $_POST['nama_campaign'];
        $tanggal_post = $_POST['tanggal_post'];
        $deskripsi = $_POST['deskripsi'];
        $gambar_lama = $_POST['gambar_lama'];
        // Upload gambar
        if(isset($_FILES["files"]) && !empty($_FILES["files"]["name"])){
            $filename = '../assets/upload_images/campaign/'.$gambar_lama;
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
                    move_uploaded_file($file_tmp,'../assets/upload_images/campaign/'.$gambar);
                }
            }
            $query = update_campaign($id, $nama_campaign, $tanggal_post, $deskripsi, $gambar);
            if($query == 'true'){
                header("Location: ../admin/views/index?pesan=sukses");
            }else if($query == 'false'){
                header("Location: ../admin/views/index?pesan=gagal");
            }else{
                echo "Error";
            }
        }else{
            $gambar = 'nodata';
            $query = update_campaign($id, $nama_campaign, $tanggal_post, $deskripsi, $gambar);
            if($query == 'true'){
                header("Location: ../admin/views/index?pesan=sukses");
            }else if($query == 'false'){
                header("Location: ../admin/views/index?pesan=gagal");
            }else{
                echo "Error";
            }
        }
    break;
    case 'delete_campaign':
        $id = $_POST['id'];
        $gambar_lama = $_POST['gambar_lama'];
        $filename = '../assets/upload_images/campaign/'.$gambar_lama;
        if(file_exists($filename)){
            unlink($filename);
        }
        $query = delete_campaign($id);
        if($query == 'true'){
            header("Location: ../admin/views/index?pesan=sukses");
        }else if($query == 'false'){
            header("Location: ../admin/views/index?pesan=gagal");
        }else{
            echo "Error";
        }
    break;

    // Kritik & Saran
    case 'add_suggestion':
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $isi = $_POST['isi'];
        $query = add_suggestion($nama, $email, $isi);
        if($query == 'true'){
            header("Location: ../view/index?pesan=sukses");
        }else if($query == 'false'){
            header("Location: ../view/index?pesan=gagal");
        }else{
            echo "Error";
        }
    break;
    case 'delete_suggestion':
        $id = $_POST['id'];
        $query = delete_suggestion($id);
        if($query == 'true'){
            header("Location: ../admin/views/index?pesan=sukses");
        }else if($query == 'false'){
            header("Location: ../admin/views/index?pesan=gagal");
        }else{
            echo "Error";
        }
    break;

    // Unknown Request 
    default:
    echo "Error";
}


?>