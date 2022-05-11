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
            header("Location: ../admin/dashboard");
            // Jika inputan salah
        }else if($decode->id == 'FALSE'){
            header("Location: ../login?salah=1");
            // Jika data tidak ditemukan
        }else if($decode->id == NULL){
            header("Location: ../login?not_found=1");
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
            header("Location: ../login?logout=1");
        }
    break;
    
    // Administrasi
    case 'add_user':
        $nama = $_POST['floatingNama'];
        $email = $_POST['floatingEmail'];
        $password = $_POST['floatingPassword'];
        $super = $_POST['floatingSuper'];
        $query = add_user($nama, $email, $password, $super);
        if($query == 'true'){
            header("Location: ../admin/admin-set?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/admin-set?gagal=1");
        }else{
            echo "Error";
        }
    break;
    case 'update_user':
        $id = $_POST['m_id'];
        $nama = $_POST['m_nama'];
        $email = $_POST['m_email'];
        $password = $_POST['m_password'];
        $super = $_POST['m_super'];
        // Query
        $query = update_user($id, $nama, $email, $password, $super);
        if($query == 'true'){
            header("Location: ../admin/admin-set?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/admin-set?gagal=1");
        }else{
            echo "Error";
        }
    break;
    case 'delete_user':
        $id = $_GET['id'];
        $query = delete_user($id);
        if($query == 'true'){
            header("Location: ../admin/admin-set?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/admin-set?gagal=1");
        }else{
            echo "Error";
        }
    break;

    // Event
    case 'add_event':
        $nama_event = $_POST['floatingNama'];
        $tempat = $_POST['floatingTempat'];
        $tanggal_post = date("Y-m-d");
        $tanggal = $_POST['floatingTanggal'];
        $deskripsi = $_POST['m_deskripsi'];
        $kategori = $_POST['floatingKategori'];
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
            header("Location: ../admin/event?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/event?gagal=1");
        }else{
            echo "Error";
        }
    break;
    case 'update_event':
        $id = $_POST['m_id'];
        $nama_event = $_POST['m_nama_edit'];
        $tempat = $_POST['m_tempat_edit'];
        $tanggal = $_POST['m_tanggal'];
        $deskripsi = $_POST['ubah_desc'];
        $kategori = $_POST['m_kategori'];
        $gambar_lama = $_POST['m_gambar_lama'];

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
                    if(is_null($gambar)){
                        $gambar = NULL;
                    }else{
                        $filename = '../assets/upload_images/event/'.$gambar_lama;
                        if(file_exists($filename)){
                            unlink($filename);
                        }
                        move_uploaded_file($file_tmp,'../assets/upload_images/event/'.$gambar);
                    }
                }
            }
            $query = update_event($id, $nama_event, $tempat, $tanggal, $deskripsi, $kategori, $gambar);
            if($query == 'true'){
                header("Location: ../admin/event?sukses=1");
            }else if($query == 'false'){
                header("Location: ../admin/event?gagal=1");
            }else{
                echo "Error";
            }
        }else{
            $gambar = NULL;
            $query = update_event($id, $nama_event, $tempat, $tanggal, $deskripsi, $kategori, $gambar);
            if($query == 'true'){
                header("Location: ../admin/event?sukses=1");
            }else if($query == 'false'){
                header("Location: ../admin/event?gagal=1");
            }else{
                echo "Error";
            }
        }
    break;
    case 'delete_event':
        $id = $_GET['id'];
        $gambar_lama = $_GET['gambar'];
        $filename = '../assets/upload_images/event/'.$gambar_lama;
        if(file_exists($filename)){
            unlink($filename);
        }
        $query = delete_event($id);
        if($query == 'true'){
            header("Location: ../admin/event?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/event?gagal=1");
        }else{
            echo "Error";
        }
    break;

    // Campaign
    case 'add_campaign':
        $nama_campaign = $_POST['nama_campaign'];
        $tanggal_post = date("Y-m-d");
        $deskripsi = $_POST['deskripsi'];
        // Upload gambar
        if(isset($_FILES['files']) && !empty($_FILES['files']['name'])){
            foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                $file_name = $key.$_FILES['files']['name'][$key];
                $file_size = $_FILES['files']['size'][$key];
                $file_tmp = $_FILES['files']['tmp_name'][$key];
                $file_type = $_FILES['files']['type'][$key];
                $original_filename = $_FILES['files']['name'][$key];
                $ext = strtolower(pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION));
                if(in_array( $ext, array('jpg', 'jpeg', 'png', 'gif', 'bmp'))) {
                    $gambar = uniqid() . '.' . $ext;
                    move_uploaded_file($file_tmp,'../assets/upload_images/campaign/'.$gambar);
                }
            }
        }
        $query = add_campaign($nama_campaign, $tanggal_post, $deskripsi, $gambar);
        if($query == 'true'){
            header("Location: ../admin/campaign?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/campaign?gagal=1");
        }else{
            echo "Error";
        }
    break;
    case 'update_campaign':
        $id = $_POST['m_id'];
        $nama_campaign = $_POST['edit_namacampaign'];
        $deskripsi = $_POST['edit_deskripsi'];
        $gambar_lama = $_POST['m_gambar_lama'];
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
                    if(is_null($gambar)){
                        $gambar = NULL;
                    }else{
                        $filename = '../assets/upload_images/campaign/'.$gambar_lama;
                        if(file_exists($filename)){
                            unlink($filename);
                        }
                        move_uploaded_file($file_tmp,'../assets/upload_images/campaign/'.$gambar);
                    }
                }
            }
            $query = update_campaign($id, $nama_campaign, $deskripsi, $gambar);
            if($query == 'true'){
                header("Location: ../admin/campaign?sukses=1");
            }else if($query == 'false'){
                header("Location: ../admin/campaign?gagal=1");
            }else{
                echo "Error";
            }
        }else{
            $gambar = NULL;
            $query = update_campaign($id, $nama_campaign, $deskripsi, $gambar);
            if($query == 'true'){
                header("Location: ../admin/campaign?sukses=1");
            }else if($query == 'false'){
                header("Location: ../admin/campaign?gagal=1");
            }else{
                echo "Error";
            }
        }
    break;
    case 'delete_campaign':
        $id = $_GET['id'];
        $gambar_lama = $_GET['gambar'];
        $filename = '../assets/upload_images/campaign/'.$gambar_lama;
        if(file_exists($filename)){
            unlink($filename);
        }
        $query = delete_campaign($id);
        if($query == 'true'){
            header("Location: ../admin/campaign?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/campaign?gagal=1");
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
            header("Location: ../admin/suggestion?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/suggestion?gagal=1");
        }else{
            echo "Error";
        }
    break;
    case 'delete_suggestion':
        $id = $_GET['id'];
        $query = delete_suggestion($id);
        if($query == 'true'){
            header("Location: ../admin/suggestion?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/suggestion?gagal=1");
        }else{
            echo "Error";
        }
    break;

    // Unknown Request 
    default:
    echo "Error";
}


?>