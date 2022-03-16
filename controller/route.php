<?php

include '../koneksi.php';
require_once '../model/login.php';
require_once '../model/add_user.php';

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

    case 'add_event':
    
    break;
}

?>