<?php

include '../koneksi.php';

function add_suggestion($nama, $email, $isi){
    global $koneksi;
    // Sanitize input
    $r_nama = mysqli_real_escape_string($koneksi, htmlspecialchars($nama, ENT_QUOTES));
    $r_email = mysqli_real_escape_string($koneksi, htmlspecialchars($email, ENT_QUOTES));
    $r_isi = mysqli_real_escape_string($koneksi, htmlspecialchars($isi, ENT_QUOTES));
    // Query
    $query = $koneksi->prepare("INSERT INTO suggestion (nama, email, isi) VALUES (?, ?, ?)");
    $query->bind_param('sss', $r_nama, $r_email, $r_isi);
    if($query->execute()){
        $response = 'true';
        return $response;
    }else{
        $response = 'false';
        return $response;
    }
}

function delete_suggestion($id){
    global $koneksi;
    // Sanitize input
    $r_id = mysqli_real_escape_string($koneksi, htmlspecialchars($id, ENT_QUOTES));
    // Query
    $query = $koneksi->prepare("DELETE FROM suggestion WHERE id=?");
    $query->bind_param('s', $r_id);
    if($query->execute()){
        $response = 'true';
        return $response;
    }else{
        $response = 'false';
        return $response;
    }
}

?>