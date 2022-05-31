<?php
    include '../koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimasuca - Bimasuca</title>
    <link rel="icon" href="assets/images/LogoIcon.png">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" type="text/css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <?php 
    
        if(isset($_GET['pesan'])){
            $pesan = $_GET['pesan'];
            if($pesan == 'sukses'){
            echo    "<script type = 'text/javascript'>
                        Swal.fire({
                        icon: 'success',
                        title: 'Berhasil !',
                        text: 'Data berhasil disimpan'
                        })
                        </script>";
            }
        }
    ?>
    <div class="wrapper">
        <!-- Header -->
        <?php
            include 'layout/header.php';
        ?>
        <section class="bg-banner">
            <div class="banner">
                <img src="assets/images/awan.png" alt="Awan">
                <img src="assets/images/banner.png" alt="Binus Malang">
                <div class="banner-text">
                    <span>Binus Malang Sustainable Campus</span>
                    <h1>BIMASUCA</h1>
                    <div>
                        <span>Scroll down</span>
                        <span><i class="fas fa-angle-down"></i></span>
                    </div>
                </div>
            </div>
        </section>
        <div class="background">
            <section class="bg-intro">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="intro-text">
                                <h2>Menjaga Kehijauan Lingkungan adalah motto kami</h2>
                                <p>
                                    Bimasuca kami bangun untuk memberikan edukasi kepada masyarakat tentang pentingnya menjaga lingkungan demi kelangsungan hidup manusia
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-5 offset-lg-1">
                            <img src="assets/images/intro.jpeg" class="w-100" alt="Education">
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-event">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="event-title">
                                <h2>Event</h2>
                                <a href="#">Selengkapnya</a>
                            </div>
                            <div class="event-list">
                                <?php
                                    $event = $koneksi->prepare("SELECT * FROM event ORDER BY id DESC LIMIT 4");
                                    $event->execute();
                                    $event_res = $event->get_result();
                                ?>
                                <?php while($event_assoc = $event_res->fetch_assoc()) { ?>
                                    <div class="event-card">
                                        <img src="assets/upload_images/event/<?= $event_assoc['gambar_cover'];?>" alt="<?= $event_assoc['gambar_cover'];?>">
                                        <a href="detailEvent.php?id=<?= $event_assoc['id'];?>">
                                            <div class="event-card-text">
                                                <h3><?php 
                                                // if(strlen($event_assoc['nama_event']) > 12){
                                                //     echo substr($event_assoc['nama_event'], 0, 18);
                                                //     echo ' ...';
                                                // }else{
                                                    echo $event_assoc['nama_event'];
                                                // }
                                                ?></h3>

                                                <?php
                                                    $date = $event_assoc['tanggal'];
                                                    $month = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                                                    $tanggal_hari = (int)date('d', strtotime($date));
                                                    $bulan_hari = $month[((int)date('m', strtotime($date))) - 1];
                                                    $tahun_hari = (int)date('Y', strtotime($date));
                                                ?>

                                                <span><?= $event_assoc['tempat'];?>, <?=$tanggal_hari.' '.$bulan_hari.' '.$tahun_hari ?></span>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-lg-5 offset-lg-1">
                            <div class="flex-center">
                                <!-- <blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/CbO9_O6pE5w/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); width: 100%;"><div style="padding:16px;"> <a href="https://www.instagram.com/p/CbO9_O6pE5w/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/CbO9_O6pE5w/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by BINUS UNIVERSITY Malang (@binus_malang)</a></p></div></blockquote> <script async src="//www.instagram.com/embed.js"></script> -->
                                <iframe style="border: none;height: 100vh" src="https://bimasuca.rf.gd/assets/plugin/instagram-feed/feed.php" width="100%"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-campaign">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                                <?php 
                                    $campaign = $koneksi->prepare("SELECT * FROM campaign ORDER BY tanggal_post ASC LIMIT 3");
                                    $campaign->execute();
                                    $campaign_res = $campaign->get_result();
                                ?>
                                <ol class="carousel-indicators">
                                    <?php for($a = 0; $a<$campaign_res->num_rows; $a++) {?>
                                        <?php if($a == 0) { ?>
                                            <li data-target="#carouselExampleCaptions" data-slide-to="<?= $a ?>" class="active"></li>
                                        <?php } else { ?>
                                            <li data-target="#carouselExampleCaptions" data-slide-to="<?= $a ?>"></li>
                                        <?php } ?>
                                    <?php } ?>
                                </ol>
                                <div class="carousel-inner">
                                    <?php $cnt = 1; ?>
                                    <?php while($campaign_assoc = $campaign_res->fetch_assoc()) { ?>
                                        <?php if($cnt == 1) { ?>
                                            <div class="carousel-item active">
                                                <img src="assets/upload_images/campaign/<?= $campaign_assoc['gambar'];?>" class="d-block w-100" alt="<?= $campaign_assoc['gambar'];?>">
                                                <div class="backdrop"></div>
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5><?= $campaign_assoc['nama_campaign'];?></h5>
                                                    <p><?= $campaign_assoc['deskripsi'];?></p>
                                                </div>
                                            </div>
                                        <?php $cnt += 1; } else { ?>
                                            <div class="carousel-item">
                                                <img src="assets/upload_images/campaign/<?= $campaign_assoc['gambar'];?>" class="d-block w-100" alt="<?= $campaign_assoc['gambar'];?>">
                                                <div class="backdrop"></div>
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5><?= $campaign_assoc['nama_campaign'];?></h5>
                                                    <p><?= $campaign_assoc['deskripsi'];?></p>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-feature">
                <div class="feature">
                    <div class="container">
                        <div class="row first">
                            <div class="col-xl-6 col-md-8">
                                <div class="feature-text">
                                    <span>Kalkulator</span>
                                    <h2>Hitung Emisi Harianmu</h2>
                                    <p style="text-align: justify;">
                                        Kalkulator untuk menghitung seberapa besar emisi yang anda keluarkan setiap harinya dan konversinya dalam bahan energi
                                    </p>
                                    <a href="kalkulator.php"><button>Buka Kalkulator</button></a>
                                </div>
                            </div>
                            <div class="col-xl-4 offset-xl-1 col-md-4">
                                <div class="flex-center">
                                    <img src="assets/images/kalkulator.png" alt="Kalkulator" class="w-100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 offset-xl-1 col-md-4">
                                <div class="flex-center">
                                    <img src="assets/images/game.png" alt="Kalkulator" class="w-100">
                                </div>
                            </div>
                            <div class="col-xl-6 offset-xl-1 col-md-8">
                                <div class="feature-text">
                                    <span>Game</span>
                                    <h2>Mainkan Game Green Maze</h2>
                                    <p style="text-align: justify;">
                                        Green Maze adalah game yang dibuat sebagai edukasi kesadaran akan kebersihan dengan cara yang lebih menarik
                                    </p>
                                    <a href="game.php"><button>Mainkan Game</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-suggest">
                <div class="container">
                    <div class="suggest-title">
                        <h2>Kritik & Saran</h2>
                        <span>Kritik & saran Anda sangat berguna bagi kami</span>
                    </div>
                    <div class="suggest">
                        <div class="row">
                            <div class="col-lg-7">
                                <form action="controller/route.php?aksi=add_suggestion" method="POST">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda ...">
                                        </div>
                                        <div class="col-6">
                                            <input type="email" id="email" name="email" placeholder="Masukkan email Anda ...">
                                        </div>
                                        <div class="col-12">
                                            <textarea placeholder="Masukkan kritik & saran Anda ..." id="isi" name="isi"></textarea>
                                            <button>Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-4 offset-lg-1">
                                <img src="assets/images/msg.png" alt="Message" class="w-100">
                            </div>
                        </div>
                    </div>
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