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

    function update_campaign($id, $nama_campaign, $deskripsi, $gambar){
        global $koneksi;
        // Sanitize input
        $r_id = mysqli_real_escape_string($koneksi, htmlspecialchars($id, ENT_QUOTES)); 
        $r_nama_campaign = mysqli_real_escape_string($koneksi, $nama_campaign);
        $r_deskripsi = mysqli_real_escape_string($koneksi, $deskripsi);
        // Query
        if($gambar == NULL){
            $query = $koneksi->prepare("UPDATE campaign SET nama_campaign=?, deskripsi=? WHERE id=?");
            $query->bind_param('sss', $r_nama_campaign, $r_deskripsi, $r_id);
            if($query->execute()){
                $response = 'true';
                return $response;
            }else{
                $response = 'false';
                return $response;
            }
        }else{
            $r_gambar = mysqli_real_escape_string($koneksi, $gambar);
            $query = $koneksi->prepare("UPDATE campaign SET nama_campaign=?, deskripsi=?, gambar=? WHERE id=?");
            $query->bind_param('ssss', $r_nama_campaign, $r_deskripsi, $r_gambar, $r_id);
            if($query->execute()){
                $response = 'true';
                return $response;
            }else{
                $response = 'false';
                return $response;
            }
        }
        
    }

    function delete_campaign($id){
        global $koneksi;
        // Sanitize input
        $r_id = mysqli_real_escape_string($koneksi, htmlspecialchars($id, ENT_QUOTES));
        // Query
        $query = $koneksi->prepare("DELETE FROM campaign WHERE id=?");
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