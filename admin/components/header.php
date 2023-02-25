<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/admin/main.css" >
  
  <!-- <link rel="stylesheet" href="../assets/library/sweetalert/sweetalert2.min.css"> -->
  <link rel="stylesheet" href="../assets/library/sweetalert2/sweetalert2.min.css">
  <link href="../assets/library/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
  <link href="../assets/library/template/css/styles.css" rel="stylesheet" >
  <link href="../assets/library/select2/css/select2.min.css" rel="stylesheet" >
  <link rel="stylesheet" type="text/css" href="../assets/library/DataTables/datatables.min.css"/>
  <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> -->

  <script src="../assets/library/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  

  <script src="../assets/library/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/library/template/js/scripts.js"></script>
  <script type="text/javascript" src="../assets/library/DataTables/datatables.min.js"></script>
  <script src="../assets/library/select2/js/select2.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->
  <!-- C:\xampp\htdocs\sbpsablon\assets\library\sweetalert2 -->

  <title>Sablon</title>
</head>
<body>
<?php
  session_start();
  if (!isset($_SESSION['id_user'])) {
      header("Location: /sbpsablon/login.php");
  }
  
  if (isset($_SESSION['message'])) {
    echo '<script>
          Swal.fire({
            position: "top-end",
            icon: "'.$_SESSION['message'][0].'",
            title: "'.$_SESSION['message'][1].'",
            showConfirmButton: false,
            timer: 1500
          });
          </script>';
      unset($_SESSION['message']);
    }
  
  ?>