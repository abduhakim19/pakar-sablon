<?php 
  $host       =   "localhost";
  $user       =   "root";
  $password   =   "";
  $database   =   "sbpsablon";
  $conn = mysqli_connect($host, $user, $password, $database);
  if (!$conn) {
    die("Koneksi tidak terhubung");
  }
?>