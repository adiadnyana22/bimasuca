<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game - Bimasuca</title>
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
        <section class="bg-game">
            <div class="container">
                <h1>Green Game</h1>
                <span>Vibrant Recycling</span>
                <iframe src="https://vibrantrecycling.ciangames.com/" frameborder="0" width="100%" height="500px"></iframe>
            </div>
        </section>
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