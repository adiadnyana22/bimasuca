<?php

include '../koneksi.php';

function login($email, $password){
    global $koneksi;
    $r_email = mysqli_real_escape_string($koneksi, htmlspecialchars($email, ENT_QUOTES));
    $r_password = mysqli_real_escape_string($koneksi, htmlspecialchars($password, ENT_QUOTES));
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
            $response_json = json_encode(array(
                'id' => $identitas['id'],
                'nama' => $identitas['nama'],
                'email' => $identitas['email'],
                'super' => $identitas['super']
            ));
            return $response_json;
        // Jika inputan salah
        }else{
            $response_json = json_encode(array(
                'id' => 'FALSE',
                'nama' => 'FALSE',
                'email' => 'FALSE',
                'super' => 'FALSE'
            ));
            return $response_json;
        }
    // Jika data tidak ditemukan
    }else{
        $response_json = json_encode(array(
            'id' => NULL,
            'nama' => NULL,
            'email' => NULL,
            'super' => NULL
        ));
        return $response_json;
    }
}

?>