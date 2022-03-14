<?php

include '../koneksi.php';
require_once '../model/login.php';

$data = $_REQUEST;

switch($data['aksi']){

    case 'login':
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = login($email, $password);
//      Jika inputan benar
        if($query == 'verified'){
            session_start();
            session_regenerate_id(true);
            $_SESSION['id'] = $identitas['id'];
            $_SESSION['nama'] = $identitas['nama'];
            $_SESSION['email'] = $identitas['email'];
            $_SESSION['super'] = $identitas['super'];
            header("Location: ../admin/views/index?pesan=sukses");
            // Jika inputan salah
        }else if($query == 'false'){
            header("Location: ../admin/views/index?pesan=salah");
            // Jika data tidak ditemukan
        }else if($query == 'nodata'){
            header("Location: ../admin/views/index?pesan=not_found");
        }
    break;
    case 'register':

    break;
}

?>