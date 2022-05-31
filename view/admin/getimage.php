<?php
    include '../../koneksi.php';
    $ident = $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT * FROM image WHERE id_event = '$ident'");
    $array = array();
    while($query_fetch = mysqli_fetch_assoc($query)){
        $link = $query_fetch['image'];
        array_push($array, $link);
    }
    echo json_encode($array);
?>