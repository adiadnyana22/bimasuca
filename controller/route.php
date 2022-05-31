<?php

include '../koneksi.php';

// Login
require_once '../model/login.php';
// Administrasi
require_once '../model/user.php';
// Kategori
require_once '../model/kategori.php';
// Event
require_once '../model/event.php';
// Campaign
require_once '../model/campaign.php';
// Kritik & Saran
require_once '../model/suggestion.php';

$data = $_REQUEST;

switch($data['aksi']){

    case 'login':
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = login($email, $password);
        $decode = json_decode($query);
        
        //  Jika inputan benar
        if($decode->id != 'FALSE' && $decode->id != NULL){
            session_start();
            session_regenerate_id(true);
            $_SESSION['id'] = $decode->id;
            $_SESSION['nama'] = $decode->nama;
            $_SESSION['email'] = $decode->email;
            $_SESSION['super'] = $decode->super;
            header("Location: ../admin/dashboard");
            // Jika inputan salah
        }else if($decode->id == 'FALSE'){
            header("Location: ../login?salah=1");
            // Jika data tidak ditemukan
        }else if($decode->id == NULL){
            header("Location: ../login?not_found=1");
        }
    break;

    case 'logout':
        if($_POST['logout']){
            // Legacy untuk compatibility PHP lama
            session_start();
            $_SESSION = array();
            // Session kill
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            // Session unset
            unset($_SESSION['id']);
            unset($_SESSION['nama']);
            unset($_SESSION['email']);
            unset($_SESSION['super']);
            session_unset();
            // Session destroy
            session_destroy();
            header("Location: ../login?logout=1");
        }
    break;
    
    // Administrasi
    case 'add_user':
        $nama = $_POST['floatingNama'];
        $email = $_POST['floatingEmail'];
        $password = $_POST['floatingPassword'];
        $super = $_POST['floatingSuper'];
        $query = add_user($nama, $email, $password, $super);
        if($query == 'true'){
            header("Location: ../admin/admin-set?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/admin-set?gagal=1");
        }else{
            echo "Error";
        }
    break;
    case 'update_user':
        $id = $_POST['m_id'];
        $nama = $_POST['m_nama'];
        $email = $_POST['m_email'];
        $password = $_POST['m_password'];
        $super = $_POST['m_super'];
        // Query
        $query = update_user($id, $nama, $email, $password, $super);
        if($query == 'true'){
            header("Location: ../admin/admin-set?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/admin-set?gagal=1");
        }else{
            echo "Error";
        }
    break;
    case 'delete_user':
        $id = $_GET['id'];
        $query = delete_user($id);
        if($query == 'true'){
            header("Location: ../admin/admin-set?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/admin-set?gagal=1");
        }else{
            echo "Error";
        }
    break;

    // Kategori
    case 'add_kategori':
        $kategori = $_POST['kategori'];
        $query = add_kategori($kategori);
        if($query == 'true'){
            header("Location: ../admin/event?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/event?gagal=1");
        }else{
            echo "Error";
        }
    break;
    case 'update_kategori':
        $kategori = $_POST['kategori'];
        $id = $_POST['id'];
        $query = update_kategori($id, $kategori);
        if($query == 'true'){
            header("Location: ../admin/event?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/event?gagal=1");
        }else{
            echo "Error";
        }
    break;
    case 'delete_kategori':
        $id = $_POST['id'];
        $query = delete_kategori($id);
        if($query == 'true'){
            header("Location: ../admin/event?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/event?gagal=1");
        }else{
            echo "Error";
        }
    break;

    // Event
    case 'add_event':
        $nama_event = $_POST['floatingNama'];
        $tempat = $_POST['floatingTempat'];
        $tanggal_post = date("Y-m-d");
        $tanggal = $_POST['floatingTanggal'];
        $deskripsi = $_POST['m_deskripsi'];
        $kategori = $_POST['floatingKategori'];
        $ident = uniqid("E");
        // Upload gambar cover
        if(isset($_FILES["files"]) && !empty($_FILES["files"]["name"])){
            foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                $file_name = $key.$_FILES['files']['name'][$key];
                $file_size =$_FILES['files']['size'][$key];
                $file_tmp =$_FILES['files']['tmp_name'][$key];
                $file_type=$_FILES['files']['type'][$key];
                $original_filename = $_FILES['files']['name'][$key];
                $ext = strtolower(pathinfo($_FILES["files"]["name"][$key], PATHINFO_EXTENSION));
                if(in_array( $ext, array('jpg', 'jpeg', 'png', 'gif', 'bmp'))) {
                    $gambar = uniqid() . '.' . $ext;
                    move_uploaded_file($file_tmp,'../assets/upload_images/event/'.$gambar);
                }
            }
        }
        // Masukkan event
        $query = add_event($nama_event, $ident, $tempat, $tanggal_post, $tanggal, $deskripsi, $gambar, $kategori);
        // Upload gambar carousel
        if(isset($_FILES["carousels"]) && !empty($_FILES["carousels"]["name"])){
            $count = 0;
            foreach($_FILES['carousels']['tmp_name'] as $key2 => $tmp_name2 ){
                $file_name2 = $key.$_FILES['carousels']['name'][$key2];
                $file_size2 =$_FILES['carousels']['size'][$key2];
                $file_tmp2 =$_FILES['carousels']['tmp_name'][$key2];
                $file_type2=$_FILES['carousels']['type'][$key2];
                $original_filename2 = $_FILES['carousels']['name'][$key2];
                $ext2 = strtolower(pathinfo($_FILES["carousels"]["name"][$key2], PATHINFO_EXTENSION));
                if(in_array( $ext2, array('jpg', 'jpeg', 'png', 'gif', 'bmp'))) {
                    $gambar2 = uniqid() . '.' . $ext2;
                    move_uploaded_file($file_tmp2,'../assets/upload_images/event/carousel/'.$gambar2);
                }
                $count = $count + 1;
                // Masukkan gambar carousel
                $query2 = add_carousel($gambar2, $ident, $count);
            }
        }
        if($query == 'true'){
            header("Location: ../admin/event?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/event?gagal=1");
        }else{
            echo "Error";
        }
    break;
    case 'update_event':
        $id = $_POST['m_id'];
        $ident = $_POST['m_ident'];
        $nama_event = $_POST['m_nama_edit'];
        $tempat = $_POST['m_tempat_edit'];
        $tanggal = $_POST['m_tanggal'];
        $deskripsi = $_POST['ubah_desc'];
        $kategori = $_POST['m_kategori'];
        $gambar_lama = $_POST['m_gambar_lama'];
        $gambar_lama1 = $_POST['carousel_lama1'];
        $gambar_lama2 = $_POST['carousel_lama2'];
        $gambar_lama3 = $_POST['carousel_lama3'];
    
        // Upload gambar cover
        if(isset($_FILES["cover"]) && !empty($_FILES["cover"]["name"])){
            $data1 = $_FILES;
            $file_name = $data1['cover']['name'];
            $file_tmp = $data1['cover']['tmp_name'];
            $file_size = $data1['cover']['size'];
            $ekstensi_cover = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
            $ext = explode('.', $file_name);
            $ekstensi_cover_real = strtoLower(end($ext));
            if(!in_array($ekstensi_cover_real, $ekstensi_cover)) {
                $gambar = uniqid() . '.' . $ext;
                if(is_null($gambar)){
                     $gambar = NULL;
                }else{
                    $filename = '../assets/upload_images/event/'.$gambar_lama;
                    if(file_exists($filename)){
                        unlink($filename);
                    }
                    move_uploaded_file($file_tmp,'assets/upload_images/event/'.$gambar);
                }
            }
            

            // Gambar 1
            if(isset($_FILES["carousels1"]) && !empty($_FILES["carousels1"]["name"])){
                $data1 = $_FILES;
                $nama_gambar1 = $data1['carousels1']['name'];
                $tmp_name1 = $data1['carousels1']['tmp_name'];
                $file_size1 = $data1['carousels1']['size'];
                $ekstensi_gambar1 = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                $ekstensi_gambar_upload1 = explode('.', $nama_gambar1);
                $ekstensi1 = strtoLower(end($ekstensi_gambar_upload1));
                if(!in_array($ekstensi1, $ekstensi_gambar1)){
                    header("Location: ../view/admin/event.php?gagal=1");
                }else{
                    $gambarc1 = uniqid() . '.' . $ekstensi1;
                    if(is_null($gambarc1)){
                        $gambarc1 = NULL;
                    }else{
                        $filename1 = '../assets/upload_images/event/carousel/'.$gambar_lama1;
                        if(file_exists($filename1)){
                            unlink($filename1);
                        }
                        move_uploaded_file($tmp_name1,'../assets/upload_images/event/carousel/'.$gambarc1);
                        $urutan1 = '1';
                        $carousel1 = $koneksi->prepare("UPDATE image SET image = ? WHERE id_event = ? AND urutan = ?");
                        $carousel1->bind_param('sss', $gambarc1, $ident, $urutan1);
                        $carousel1->execute();
                    }
                }
            }

            // Gambar 2
            if(isset($_FILES["carousels2"]) && !empty($_FILES["carousels2"]["name"])){
                $data2 = $_FILES;
                $nama_gambar2 = $data2['carousels2']['name'];
                $tmp_name2 = $data2['carousels2']['tmp_name'];
                $file_size2 = $data2['carousels2']['size'];
                $ekstensi_gambar2 = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                $ekstensi_gambar_upload2 = explode('.', $nama_gambar2);
                $ekstensi2 = strtoLower(end($ekstensi_gambar_upload2));
                if(!in_array($ekstensi2, $ekstensi_gambar2)){
                    header("Location: ../view/admin/event.php?gagal=1");
                }else{
                    $gambarc2 = uniqid() . '.' . $ekstensi2;
                    if(is_null($gambarc2)){
                        $gambarc2 = NULL;
                    }else{
                        $filename2 = '../assets/upload_images/event/carousel/'.$gambar_lama2;
                        if(file_exists($filename2)){
                            unlink($filename2);
                        }
                        move_uploaded_file($tmp_name2,'../assets/upload_images/event/carousel/'.$gambarc2);
                        $urutan2 = '2';
                        $carousel2 = $koneksi->prepare("UPDATE image SET image = ? WHERE id_event = ? AND urutan = ?");
                        $carousel2->bind_param('sss', $gambarc2, $ident, $urutan2);
                        $carousel2->execute();
                    }
                }
            }

            // Gambar 3
            if(isset($_FILES["carousels3"]) && !empty($_FILES["carousels3"]["name"])){
                $data3 = $_FILES;
                $nama_gambar3 = $data3['carousels3']['name'];
                $tmp_name3 = $data3['carousels3']['tmp_name'];
                $file_size3 = $data3['carousels3']['size'];
                $ekstensi_gambar3 = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                $ekstensi_gambar_upload3 = explode('.', $nama_gambar3);
                $ekstensi3 = strtoLower(end($ekstensi_gambar_upload3));
                if(!in_array($ekstensi3, $ekstensi_gambar3)){
                    header("Location: ../view/admin/event.php?gagal=1");
                }else{
                    $gambarc3 = uniqid() . '.' . $ekstensi3;
                    if(is_null($gambarc3)){
                        $gambarc3 = NULL;
                    }else{
                        $filename3 = '../assets/upload_images/event/carousel/'.$gambar_lama3;
                        if(file_exists($filename3)){
                            unlink($filename3);
                        }
                        move_uploaded_file($tmp_name3,'../assets/upload_images/event/carousel/'.$gambarc3);
                        $urutan1 = '3';
                        $carousel3 = $koneksi->prepare("UPDATE image SET image = ? WHERE id_event = ? AND urutan = ?");
                        $carousel3->bind_param('sss', $gambarc3, $ident, $urutan3);
                        $carousel3->execute();
                    }
                }
            }

            $query = update_event($id, $nama_event, $tempat, $tanggal, $deskripsi, $kategori, $gambar);
            if($query == 'true'){
                header("Location: ../admin/event?sukses=1");
            }else if($query == 'false'){
                header("Location: ../admin/event?gagal=1");
            }else{
                echo "Error";
            }
            // Tidak edit cover
        }else{
            // Gambar 1
            if(isset($_FILES["carousels1"]) && !empty($_FILES["carousels1"]["name"])){
                $data1 = $_FILES;
                $nama_gambar1 = $data1['carousels1']['name'];
                $tmp_name1 = $data1['carousels1']['tmp_name'];
                $file_size1 = $data1['carousels1']['size'];
                $ekstensi_gambar1 = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                $ekstensi_gambar_upload1 = explode('.', $nama_gambar1);
                $ekstensi1 = strtoLower(end($ekstensi_gambar_upload1));
                if(!in_array($ekstensi1, $ekstensi_gambar1)){
                    header("Location: ../admin/event?gagal=1");
                }else{
                    $gambarc1 = uniqid() . '.' . $ekstensi1;
                    if(is_null($gambarc1)){
                        $gambarc1 = NULL;
                    }else{
                        $filename1 = '../assets/upload_images/event/carousel/'.$gambar_lama1;
                        if(file_exists($filename1)){
                            unlink($filename1);
                        }
                        move_uploaded_file($tmp_name1,'../assets/upload_images/event/carousel/'.$gambarc1);
                        $urutan1 = '1';
                        $carousel1 = $koneksi->prepare("UPDATE image SET image = ? WHERE id_event = ? AND urutan = ?");
                        $carousel1->bind_param('sss', $gambarc1, $ident, $urutan1);
                        $carousel1->execute();
                    }
                }
            }

            // Gambar 2
            if(isset($_FILES["carousels2"]) && !empty($_FILES["carousels2"]["name"])){
                $data2 = $_FILES;
                $nama_gambar2 = $data2['carousels2']['name'];
                $tmp_name2 = $data2['carousels2']['tmp_name'];
                $file_size2 = $data2['carousels2']['size'];
                $ekstensi_gambar2 = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                $ekstensi_gambar_upload2 = explode('.', $nama_gambar2);
                $ekstensi2 = strtoLower(end($ekstensi_gambar_upload2));
                if(!in_array($ekstensi2, $ekstensi_gambar2)){
                    header("Location: ../admin/event?gagal=1");
                }else{
                    $gambarc2 = uniqid() . '.' . $ekstensi2;
                    if(is_null($gambarc2)){
                        $gambarc2 = NULL;
                    }else{
                        $filename2 = '../assets/upload_images/event/carousel/'.$gambar_lama2;
                        if(file_exists($filename2)){
                            unlink($filename2);
                        }
                        move_uploaded_file($tmp_name2,'../assets/upload_images/event/carousel/'.$gambarc2);
                        $urutan2 = '2';
                        $carousel2 = $koneksi->prepare("UPDATE image SET image = ? WHERE id_event = ? AND urutan = ?");
                        $carousel2->bind_param('sss', $gambarc2, $ident, $urutan2);
                        $carousel2->execute();
                    }
                }
            }

            // Gambar 3
            if(isset($_FILES["carousels3"]) && !empty($_FILES["carousels3"]["name"])){
                $data3 = $_FILES;
                $nama_gambar3 = $data3['carousels3']['name'];
                $tmp_name3 = $data3['carousels3']['tmp_name'];
                $file_size3 = $data3['carousels3']['size'];
                $ekstensi_gambar3 = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                $ekstensi_gambar_upload3 = explode('.', $nama_gambar3);
                $ekstensi3 = strtoLower(end($ekstensi_gambar_upload3));
                if(!in_array($ekstensi3, $ekstensi_gambar3)){
                    header("Location: ../admin/event?gagal=1");
                }else{
                    $gambarc3 = uniqid() . '.' . $ekstensi3;
                    if(is_null($gambarc3)){
                        $gambarc3 = NULL;
                    }else{
                        $filename3 = '../assets/upload_images/event/carousel/'.$gambar_lama3;
                        if(file_exists($filename3)){
                            unlink($filename3);
                        }
                        move_uploaded_file($tmp_name3,'../assets/upload_images/event/carousel/'.$gambarc3);
                        $urutan3 = '3';
                        $carousel3 = $koneksi->prepare("UPDATE image SET image = ? WHERE id_event = ? AND urutan = ?");
                        $carousel3->bind_param('sss', $gambarc3, $ident, $urutan3);
                        $result = $carousel3->execute();
                    }
                }
            }
            $gambar = NULL;
            $query = update_event($id, $nama_event, $tempat, $tanggal, $deskripsi, $kategori, $gambar);
            if($query == 'true'){
                header("Location: ../admin/event?sukses=1");
            }else if($query == 'false'){
                header("Location: ../admin/event?gagal=1");
            }else{
                echo "Error";
            }
        }
    break;
    case 'delete_event':
        $id = $_GET['id'];
        $gambar_lama = $_GET['gambar'];
        $ident = $_GET['ident'];
        $filename = '../assets/upload_images/event/'.$gambar_lama;
        if(file_exists($filename)){
            unlink($filename);
        }
        // Hapus carousel *terpaksa agak menyimpang dari MVC
        $cek_file = mysqli_query($koneksi, "SELECT * FROM image WHERE id_event = '$ident'");
        while($isi_carousel = mysqli_fetch_assoc($cek_file)){
            $filename_carousel = '../assets/upload_images/event/carousel/'.$isi_carousel['image'];
            if(file_exists($filename_carousel)){
                unlink($filename_carousel);
            }
        }
        $query = delete_event($id, $ident);
        if($query == 'true'){
            header("Location: ../admin/event?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/event?gagal=1");
        }else{
            echo "Error";
        }
    break;

    // Campaign
    case 'add_campaign':
        $nama_campaign = $_POST['nama_campaign'];
        $tanggal_post = date("Y-m-d");
        $deskripsi = $_POST['deskripsi'];
        // Upload gambar
        if(isset($_FILES['files']) && !empty($_FILES['files']['name'])){
            foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                $file_name = $key.$_FILES['files']['name'][$key];
                $file_size = $_FILES['files']['size'][$key];
                $file_tmp = $_FILES['files']['tmp_name'][$key];
                $file_type = $_FILES['files']['type'][$key];
                $original_filename = $_FILES['files']['name'][$key];
                $ext = strtolower(pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION));
                if(in_array( $ext, array('jpg', 'jpeg', 'png', 'gif', 'bmp'))) {
                    $gambar = uniqid() . '.' . $ext;
                    move_uploaded_file($file_tmp,'../assets/upload_images/campaign/'.$gambar);
                }
            }
        }
        $query = add_campaign($nama_campaign, $tanggal_post, $deskripsi, $gambar);
        if($query == 'true'){
            header("Location: ../admin/campaign?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/campaign?gagal=1");
        }else{
            echo "Error";
        }
    break;
    case 'update_campaign':
        $id = $_POST['m_id'];
        $nama_campaign = $_POST['edit_namacampaign'];
        $deskripsi = $_POST['edit_deskripsi'];
        $gambar_lama = $_POST['m_gambar_lama'];
        // Upload gambar
        if(isset($_FILES["files"]) && !empty($_FILES["files"]["name"])){
            foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
                $file_name = $key.$_FILES['files']['name'][$key];
                $file_size =$_FILES['files']['size'][$key];
                $file_tmp =$_FILES['files']['tmp_name'][$key];
                $file_type=$_FILES['files']['type'][$key];
                $original_filename = $_FILES['files']['name'][$key];
                $ext = strtolower(pathinfo($_FILES["files"]["name"][$key], PATHINFO_EXTENSION));
                if(in_array( $ext, array('jpg', 'jpeg', 'png', 'gif', 'bmp'))) {
                    $gambar = uniqid() . '.' . $ext;
                    if(is_null($gambar)){
                        $gambar = NULL;
                    }else{
                        $filename = '../assets/upload_images/campaign/'.$gambar_lama;
                        if(file_exists($filename)){
                            unlink($filename);
                        }
                        move_uploaded_file($file_tmp,'../assets/upload_images/campaign/'.$gambar);
                    }
                }
            }
            $query = update_campaign($id, $nama_campaign, $deskripsi, $gambar);
            if($query == 'true'){
                header("Location: ../admin/campaign?sukses=1");
            }else if($query == 'false'){
                header("Location: ../admin/campaign?gagal=1");
            }else{
                echo "Error";
            }
        }else{
            $gambar = NULL;
            $query = update_campaign($id, $nama_campaign, $deskripsi, $gambar);
            if($query == 'true'){
                header("Location: ../admin/campaign?sukses=1");
            }else if($query == 'false'){
                header("Location: ../admin/campaign?gagal=1");
            }else{
                echo "Error";
            }
        }
    break;
    case 'delete_campaign':
        $id = $_GET['id'];
        $gambar_lama = $_GET['gambar'];
        $filename = '../assets/upload_images/campaign/'.$gambar_lama;
        if(file_exists($filename)){
            unlink($filename);
        }
        $query = delete_campaign($id);
        if($query == 'true'){
            header("Location: ../admin/campaign?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/campaign?gagal=1");
        }else{
            echo "Error";
        }
    break;

    // Kritik & Saran
    case 'add_suggestion':
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $isi = $_POST['isi'];
        $query = add_suggestion($nama, $email, $isi);
        if($query == 'true'){
            header("Location: ../beranda?pesan=sukses");
        }else if($query == 'false'){
            header("Location: ../beranda?pesan=gagal");
        }else{
            echo "Error";
        }
    break;
    case 'delete_suggestion':
        $id = $_GET['id'];
        $query = delete_suggestion($id);
        if($query == 'true'){
            header("Location: ../admin/suggestion?sukses=1");
        }else if($query == 'false'){
            header("Location: ../admin/suggestion?gagal=1");
        }else{
            echo "Error";
        }
    break;

    // Unknown Request 
    default:
    echo "Error";
}


?>