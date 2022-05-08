<?php

    include '../koneksi.php';

    function add_event($nama_event, $tempat, $tanggal_post, $tanggal, $deskripsi, $gambar, $kategori){
        global $koneksi;
        // Sanitize input
        $r_nama_event = mysqli_real_escape_string($koneksi, $nama_event);
        $r_tempat = mysqli_real_escape_string($koneksi, $tempat);
        $r_tanggal_post = mysqli_real_escape_string($koneksi, $tanggal_post);
        $r_tanggal = mysqli_real_escape_string($koneksi, $tanggal);
        $r_deskripsi = mysqli_real_escape_string($koneksi, $deskripsi);
        $r_gambar = mysqli_real_escape_string($koneksi, $gambar);
        $r_kategori = mysqli_real_escape_string($koneksi, $kategori);
        // Query
        $query = $koneksi->prepare("INSERT INTO event (nama_event, tempat, tanggal_post, tanggal, deskripsi, gambar, kategori) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param('sssssss', $r_nama_event, $r_tempat, $r_tanggal_post, $r_tanggal, $r_deskripsi, $r_gambar, $r_kategori);
        if($query->execute()){
            $response = 'true';
            return $response;
        }else{
            $response = 'false';
            return $response;
        }
    }

    function update_event($id, $nama_event, $tempat, $tanggal, $deskripsi, $kategori, $gambar){
        global $koneksi;
        // Sanitize input
        $r_id = mysqli_real_escape_string($koneksi, htmlspecialchars($id, ENT_QUOTES)); 
        $r_nama_event = mysqli_real_escape_string($koneksi, $nama_event);
        $r_tempat = mysqli_real_escape_string($koneksi, $tempat);
        $r_tanggal = mysqli_real_escape_string($koneksi, $tanggal);
        $r_deskripsi = mysqli_real_escape_string($koneksi, $deskripsi);
        $r_kategori = mysqli_real_escape_string($koneksi, $kategori);
        // Query
        if($gambar == NULL){
            $query = $koneksi->prepare("UPDATE event SET nama_event=?, tempat=?, tanggal=?, deskripsi=?, kategori=? WHERE id=?");
            $query->bind_param('ssssss', $r_nama_event, $r_tempat, $r_tanggal, $r_deskripsi, $r_kategori, $r_id);
            if($query->execute()){
                $response = 'true';
                return $response;
            }else{
                $response = 'false';
                return $response;
            }
        }else{
            $r_gambar = mysqli_real_escape_string($koneksi, $gambar);
            $query = $koneksi->prepare("UPDATE event SET nama_event=?, tempat=?, tanggal=?, deskripsi=?, kategori=?, gambar=? WHERE id=?");
            $query->bind_param('sssssss', $r_nama_event, $r_tempat, $r_tanggal, $r_deskripsi, $r_kategori, $r_gambar, $r_id);
            if($query->execute()){
                $response = 'true';
                return $response;
            }else{
                $response = 'false';
                return $response;
            }
        }
        
    }

    function delete_event($id){
        global $koneksi;
        // Sanitize input
        $r_id = mysqli_real_escape_string($koneksi, htmlspecialchars($id, ENT_QUOTES));
        // Query
        $query = $koneksi->prepare("DELETE FROM event WHERE id=?");
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