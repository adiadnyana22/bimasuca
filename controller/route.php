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