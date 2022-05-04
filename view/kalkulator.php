<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Emiss - Binus Malang Sustainable Campus</title>
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
            <section class="bg-judul">
                <div class="container">
                    <h1>Kalkulator Emisi Harian</h1>
                </div>
            </section>
            <section class="bg-kalkulator">
                <div class="container">
                    <div class="kalkulator-section">
                        <h2>Alat Transportasi</h2>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/motor.png" alt="Motor" class="w-100">
                                        <span>Motor</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>KM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/mobil.png" alt="Mobil" class="w-100">
                                        <span>Mobil</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>KM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/kereta.png" alt="Kereta" class="w-100">
                                        <span>Kereta</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>KM</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/bus.png" alt="Bus" class="w-100">
                                        <span>Bus</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>KM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kalkulator-section">
                        <h2>Alat Rumah Tangga</h2>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/ac.png" alt="AC" class="w-100">
                                        <span>AC</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>Jam</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/komputer.png" alt="Komputer" class="w-100">
                                        <span>Komputer</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>Jam</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/kulkas.png" alt="Kulkas" class="w-100">
                                        <span>Kulkas</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>Jam</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/setrika.png" alt="Setrika" class="w-100">
                                        <span>Setrika</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>Jam</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/mesinCuci.png" alt="Mesin Cuci" class="w-100">
                                        <span>Mesin Cuci</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>Jam</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/hairDryer.png" alt="Hair Dryer" class="w-100">
                                        <span>Hair Dryer</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>Jam</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/microwave.png" alt="Microwave" class="w-100">
                                        <span>Microwave</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>Jam</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="kalkulator-card">
                                    <div class="icon">
                                        <img src="../assets/images/Icon/printer.png" alt="Printer" class="w-100">
                                        <span>Printer</span>
                                    </div>
                                    <div class="input">
                                        <input type="text" placeholder="Insert number here">
                                        <span>Jam</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-hasilEmisi">
                <div class="container h-100">
                    <div class="flex-center">
                        <div>
                            <span>Total Emisi Anda</span>
                            <h2>32393 BTU</h2>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-convertEmisi">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <p>Energi yang anda gunakan setara dengan</p>
                            <span>1 Kg Batu Bara</span>
                            <div class="listConvert">
                                <span>2 Kg Kayu Bakar</span>
                                <span>2 Liter Bensin</span>
                                <span>2 Liter LPG</span>
                                <span>2 Liter Solar</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="../assets/images/batuBara.png" alt="Batu Bara" class="w-100 mt-1">
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