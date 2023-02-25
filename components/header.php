<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/user/main.css">
  <link href="./assets/library/select2/css/select2.min.css" rel="stylesheet" >
  <link rel="stylesheet" type="text/css" href="./assets/library/DataTables/datatables.min.css"/>

  <link rel="stylesheet" href="./assets/library/sweetalert2/sweetalert2.min.css">
  <link href="./assets/library/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

  <script src="./assets/library/sweetalert2/sweetalert2.all.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script type="text/javascript" src="./assets/library/DataTables/datatables.min.js"></script>
  <script src="./assets/library/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/library/select2/js/select2.min.js"></script>
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

  <title>Sablon</title>
  <body>
  <?php
    session_start();
    
    if (isset($_SESSION['message'])) {
      // var_dump('hello');
      echo '<script>
            console.log("hello");
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
</head>