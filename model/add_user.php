<?php 

include '../koneksi.php';

function add_user($nama, $email, $password, $super){
    global $koneksi;
    // Sanitize input
    $r_nama = mysqli_real_escape_string($koneksi, htmlspecialchars($nama, ENT_QUOTES));
    $r_email = mysqli_real_escape_string($koneksi, htmlspecialchars($email, ENT_QUOTES));
    $r_super = mysqli_real_escape_string($koneksi, htmlspecialchars($super, ENT_QUOTES));
    // Hash password
    $ent_password = mysqli_real_escape_string($koneksi, htmlspecialchars($password, ENT_QUOTES));
    $r_password = password_hash($ent_password, PASSWORD_DEFAULT);
    // Masukkan ke database
    $query = $koneksi->prepare("INSERT INTO admin (nama, email, password, super) VALUES (?, ?, ?, ?)");
    $query->bind_param('ssss', $r_nama, $r_email, $r_password, $r_super);
    if($query->execute()){
        $response = 'true';
        return $response;
    }else{
        $response = 'false';
        return $response;
    }
}

?>