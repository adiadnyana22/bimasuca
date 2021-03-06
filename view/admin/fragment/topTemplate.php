<?php
  session_start();
  session_regenerate_id(true);
  if(!$_SESSION['id']){
    header("Location: ../login.php?pesan=nologin");
  }
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="icon" href="../../assets/images/LogoIcon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="../../assets/css/styleAdmin.css">
  <script src="https://kit.fontawesome.com/f0f2d9386c.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tiny.cloud/1/nns9dr1li8ktblwem27nin3svzbxy1spk5qi838b96r4jmjf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="wrapper">
    <?php
      include 'sidebar.php';
    ?>
    <div class="main">
      <?php
        include 'navbar.php';
      ?>
      <div class="content">
        