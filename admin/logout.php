<?php
  session_start();
  session_destroy();

  $_SESSION['message'] = "Logout Berhasil";
  header("Location: /sbpsablon/login.php");
?>