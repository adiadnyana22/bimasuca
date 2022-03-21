<?php

    include '../koneksi.php';

    function add_campaign($nama_campaign, $tanggal_post, $deskripsi, $gambar){
        global $koneksi;
        // Sanitize input
        $r_nama_campaign = mysqli_real_escape_string($koneksi, $nama_campaign);
        $r_tanggal_post = mysqli_real_escape_string($koneksi, $tanggal_post);
        $r_deskripsi = mysqli_real_escape_string($koneksi, $deskripsi);
        $r_gambar = mysqli_real_escape_string($koneksi, $gambar);
        // Query
        $query = $koneksi->prepare("INSERT INTO campaign (nama_campaign, tanggal_post, deskripsi, gambar) VALUES (?, ?, ?, ?)");
        $query->bind_param('ssss', $r_nama_campaign, $r_tanggal_post, $r_deskripsi, $r_gambar);
        if($query->execute()){
            $response = 'true';
            return $response;
        }else{
            $response = 'false';
            return $response;
        }
    }

    !<-- HellowThere Reader. !->

?>