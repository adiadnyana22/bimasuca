<?php

include '../koneksi.php';

// Add kategori

function add_kategori($nama_kategori){
    global $koneksi;
    $query = $koneksi->prepare("INSERT INTO kategori (nama) VALUES (?)");
    $query->bind_param('s', $nama_kategori);
    if($query->execute()){
        $response = 'true';
        return $response;
    }else{
        $response = 'false';
        return $response;
    }
}

// Update kategori

function update_kategori($id, $nama_kategori){
    global $koneksi;
    $query = $koneksi->prepare("UPDATE kategori SET nama=? WHERE id=?");
    $query->bind_param('ss', $nama_kategori, $id);
    if($query->execute()){
        $response = 'true';
        return $response;
    }else{
        $response = 'false';
        return $response;
    }
}

// Delete kategori

function delete_kategori($id){
    global $koneksi;
    $query = $koneksi->prepare("DELETE FROM kategori WHERE id=?");
    $query->bind_param('s', $id);
    if($query->execute()){
        $response = 'true';
        return $response;
    }else{
        $response = 'false';
        return $response;
    }
}

?>