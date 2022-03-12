<?php

include '../koneksi.php';

$data = $_REQUEST;

switch($data['aksi']){

    case 'login':
        global $koneksi;
        $r_email = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['email'], ENT_QUOTES));
        $r_password = mysqli_real_escape_string($koneksi, htmlspecialchars($_POST['password'], ENT_QUOTES));
        $query = $koneksi->prepare("SELECT * FROM admin WHERE email = ?");
        $query->bind_param('s', $r_email);
        $query->execute();
        $query_result = $query->get_result();
        // Jika data ditemukan
        if($query_result->num_rows > 0){
            $identitas = $query_result->fetch_assoc();
            $c_password = $identitas['password'];
            $verifikasi_id = password_verify($r_password, $c_password);
            // Jika inputan benar
            if($verifikasi_id){
                session_start();
                session_regenerate_id(true);
                $_SESSION['id'] = $identitas['id'];
                $_SESSION['nama'] = $identitas['nama'];
                $_SESSION['email'] = $identitas['email'];
                $_SESSION['super'] = $identitas['super'];
                header("Location: ../admin/views/index?pesan=sukses");
            // Jika inputan salah
            }else{
                header("Location: ../admin/views/index?pesan=salah");
            }
        // Jika data tidak ditemukan
        }else{
            header("Location: ../admin/views/index?pesan=n_found");
        }
    break;
    case 'register':

    break;
}

?>