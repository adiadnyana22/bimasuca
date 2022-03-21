<?php

include '../koneksi.php';

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