<?php
    include '../koneksi.php';
    $id = isset($_GET['id']);
    $query = $koneksi->prepare("SELECT 
    event.id, nama_event, tempat, tanggal_post, tanggal, deskripsi, gambar, 
    kategori.kategori AS nama_kategori, event.kategori AS id_kategori 
    FROM event INNER JOIN kategori ON event.kategori = kategori.id
    WHERE event.id = ?");
    $query->bind_param('s', $id);
    $query->execute();
    $query_res = $query->get_result();
    $query_fetch = $query_res->fetch_assoc();

    // Tanggal Post
    $date = $query_fetch['tanggal_post'];
    $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $tanggal_hari = (int)date('d', strtotime($date));
    $bulan_hari = $month[((int)date('m', strtotime($date))) - 1];
    $tahun_hari = (int)date('Y', strtotime($date));
    // Tanggal Event
    $date_event = $query_fetch['tanggal'];
    $month_event = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $tanggal_hari_event = (int)date('d', strtotime($date_event));
    $bulan_hari_event = $month_event[((int)date('m', strtotime($date_event))) - 1];
    $tahun_hari_event = (int)date('Y', strtotime($date_event));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $query_fetch['nama_event']; ?> - Binus Malang Sustainable Campus</title>
    <link rel="icon" href="../assets/images/LogoIcon.png">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" type="text/css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" /> -->
    <link rel="stylesheet" href="../assets/css/styleUser.css">
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
            <section class="bg-eventDetailInfo">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <img src="../assets/upload_images/event/<?= $query_fetch['gambar']; ?>" alt="" class="w-100">
                        </div>
                        <div class="offset-lg-1 col-lg-6">
                            <div class="flex-center">
                                <div class="eventDetailText">
                                    <h1><?= $query_fetch['nama_event']; ?></h1>
                                    <div class="row mb-2 mt-4">
                                        <div class="col-5">
                                            <span>Kategori</span>
                                        </div>
                                        <div class="col-7">
                                            <b><?= $query_fetch['nama_kategori']; ?></b>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-5">
                                            <span>Tempat</span>
                                        </div>
                                        <div class="col-7">
                                            <b><?= $query_fetch['tempat']; ?></b>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-5">
                                            <span>Tanggal Event</span>
                                        </div>
                                        <div class="col-7">
                                            <b><?=$tanggal_hari_event.' '.$bulan_hari_event.' '.$tahun_hari_event ?></b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <span>Tanggal Post</span>
                                        </div>
                                        <div class="col-7">
                                            <b><?=$tanggal_hari.' '.$bulan_hari.' '.$tahun_hari ?></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-eventDetailDesc">
                <div class="container">
                    <p>
                        <?= $query_fetch['deskripsi']; ?>
                    </p>
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