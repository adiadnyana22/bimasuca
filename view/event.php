<?php
    include '../koneksi.php';
    if(isset($_GET['cari'])){
        $cari = $_GET['cari'];
        $query = "SELECT 
        event.id, nama_event, tempat, tanggal_post, tanggal, deskripsi, gambar, 
        kategori.kategori AS nama_kategori, event.kategori AS id_kategori 
        FROM event INNER JOIN kategori ON event.kategori = kategori.id
        WHERE (nama_event LIKE '%$cari%') ORDER BY tanggal DESC";
    }else{
        $query = "SELECT event.id, nama_event, tempat, tanggal_post, tanggal, deskripsi, gambar, kategori.kategori AS nama_kategori, event.kategori AS id_kategori FROM event INNER JOIN kategori ON event.kategori = kategori.id ORDER BY tanggal DESC";
    }
    $exec = mysqli_query($koneksi, $query);

    $jumlahDataHalaman = 2;
    $totalData = mysqli_num_rows($exec);
    $jumlahHalaman = ceil($totalData/$jumlahDataHalaman);

    $halamanAktif = isset($_GET['halaman']) ? $_GET['halaman'] : 1;

    $awalData = ($jumlahDataHalaman * $halamanAktif) - $jumlahDataHalaman;

    $query.=" LIMIT $awalData, $jumlahDataHalaman";
    $exec = mysqli_query($koneksi,$query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event - Binus Malang Sustainable Campus</title>
    <link rel="icon" href="assets/images/LogoIcon.png">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" type="text/css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" /> -->
    <link rel="stylesheet" href="assets/css/styleUser.css">
    <script src="https://kit.fontawesome.com/f0f2d9386c.js" crossorigin="anonymous"></script>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <!-- Header -->
        <?php
            include 'layout/header.php';
        ?>
        <div class="background">
            <section class="bg-eventSearch">
                <div class="container">
                    <h1>Event List</h1>
                    <div class="input">
                        <form action="event" class="d-flex justify-content-between w-100" method="GET">
                            <?php if(isset($_GET['cari'])) {?>
                                <input type="text" placeholder="Masukkan Nama Event Disini ..." id="cari" name="cari" value="<?=$cari?>">
                            <?php } else { ?>
                                <input type="text" placeholder="Masukkan Nama Event Disini ..." id="cari" name="cari">
                            <?php } ?>
                            <button>Cari</button>
                        </form>
                    </div>
                </div>
            </section>
            <section class="bg-eventList">
                <div class="container">
                    <div class="eventList-container">
                        <?php while($event_fetch = mysqli_fetch_array($exec)) { ?>
                            <div class="eventList-card">
                                <?php 
                                    $date = $event_fetch['tanggal'];
                                    $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                                    $tanggal_hari = (int)date('d', strtotime($date));
                                    $bulan_hari = $month[((int)date('m', strtotime($date))) - 1];
                                    $tahun_hari = (int)date('Y', strtotime($date));
                                ?>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="eventList-image">
                                            <img src="assets/upload_images/event/<?=$event_fetch['gambar'];?>" alt="<?=$event_fetch['gambar'];?>" class="w-100">
                                            <div class="eventList-kategori">
                                                <span><?=$event_fetch['nama_kategori'];?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="eventList-text">
                                            <a href="detailEvent?id=<?=$event_fetch['id'];?>">
                                                <h2><?=$event_fetch['nama_event'];?></h2>
                                            </a>
                                            <span><?=$event_fetch['tempat'];?> / <?=$tanggal_hari.' '.$bulan_hari.' '.$tahun_hari ?></span>
                                            <p>
                                                <?=strip_tags($event_fetch['deskripsi']);?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- Tidak ada pencarian -->
                    <?php if(!isset($_GET['cari']) && $totalData > 0) { ?>
                        <div class="eventList-page">
                            <?php if($halamanAktif - 1 == 0 && $halamanAktif + 1 <= $jumlahHalaman) { ?>
                                <input type="text" value="<?= $halamanAktif ?>" readonly>
                                <a href="?halaman=<?= $halamanAktif + 1 ?>">></a>
                            <?php } else if($halamanAktif - 1 != 0 && $halamanAktif + 1 <= $jumlahHalaman) { ?>
                                <a href="?halaman=<?= $halamanAktif - 1 ?>"><</a>
                                <input type="text" value="<?= $halamanAktif ?>" readonly>
                                <a href="?halaman=<?= $halamanAktif + 1 ?>">></a>
                            <?php } else if($halamanAktif == 1 && $halamanAktif == $jumlahHalaman) { ?>
                                <input type="text" value="<?= $halamanAktif ?>" readonly>
                            <?php } else { ?>
                                <a href="?halaman=<?= $halamanAktif - 1 ?>"><</a>
                                <input type="text" value="<?= $halamanAktif ?>" readonly>
                            <?php } ?>
                        </div>
                    <!-- Ada pencarian dan ketemu -->
                    <?php } else if (isset($_GET['cari']) && $totalData > 0) { ?>
                        <div class="eventList-page">
                            <?php if($halamanAktif - 1 == 0 && $halamanAktif + 1 <= $jumlahHalaman) { ?>
                                <input type="text" value="<?= $halamanAktif ?>" readonly>
                                <a href="?halaman=<?= $halamanAktif + 1 ?>&cari=<?= $cari ?>">></a>
                            <?php } else if($halamanAktif - 1 != 0 && $halamanAktif + 1 <= $jumlahHalaman) { ?>
                                <a href="?halaman=<?= $halamanAktif - 1 ?>&cari=<?= $cari ?>"><</a>
                                <input type="text" value="<?= $halamanAktif ?>" readonly>
                                <a href="?halaman=<?= $halamanAktif + 1 ?>&cari=<?= $cari ?>">></a>
                            <?php } else if($halamanAktif == 1 && $halamanAktif == $jumlahHalaman) { ?>
                                <input type="text" value="<?= $halamanAktif ?>" readonly>
                            <?php } else { ?>
                                <a href="?halaman=<?= $halamanAktif - 1 ?>&cari=<?= $cari ?>"><</a>
                                <input type="text" value="<?= $halamanAktif ?>" readonly>
                            <?php } ?>
                        </div>
                    <!-- Ada pencarian dan tidak ketemu -->
                    <?php } else if (isset($_GET['cari']) && $totalData == 0) { ?>
                        <div class="eventList-page">
                            <p>Data pencarian tidak ditemukan</p>
                        </div>
                    <?php } ?>
                </div>
            </section>
        </div>
        <!-- Footer -->
        <?php
            include 'layout/footer.php';
        ?>
    </div>
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script>
        document.querySelector(".mobile-overlay .close").addEventListener("click", () => {
            document.querySelector(".mobile-overlay").style.width = 0;
        })

        document.querySelector(".bars").addEventListener("click", () => {
            document.querySelector(".mobile-overlay").style.width = "100%";
        })

        window.addEventListener("scroll", () => {
            if(window.scrollY <= 50){
                document.querySelector("header").classList.remove("header-background");
            } else {
                document.querySelector("header").classList.add("header-background");
            }
        })
    </script>
</body>
</html>