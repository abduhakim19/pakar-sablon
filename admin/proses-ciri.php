<?php 
  session_start();
  require('../database/koneksi.php');

  if (isset($_POST['simpan'])) {
    $kode = $_POST['inputKodeCiri'];
    $ciri = $_POST['inputCiri'];
    $query = "INSERT INTO `tb_ciri`(`kd_ciri`, `ciri`) 
              VALUES ('$kode','$ciri')";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $_SESSION['message'] = ["success", "Data Berhasil DiSimpan"];
    } else {
      $_SESSION['message'] = ["warning","Data Gagal DiSimpan"];
    }
    header("Location: ciri.php");
  }

  if (isset($_GET['name']) =='hapus') {
    $id = $_GET['id'];
    $query = "DELETE FROM tb_ciri WHERE id_ciri =$id";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $_SESSION['message'] = ["success", "Data Berhasil Dihapus"];
    } else {
      $_SESSION['message'] = ["warning", "Data Gagal Dihapus"];
    }
    header("Location: ciri.php");
  }

  if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $kode = $_POST['inputKodeCiri'];
    $ciri = $_POST['inputCiri'];
    $query = "UPDATE `tb_ciri` SET `kd_ciri`='$kode',`ciri`='$ciri'
              WHERE `id_ciri`=$id";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $_SESSION['message'] = ["success", "Data Berhasil Diedit"];
    } else {
      $_SESSION['message'] = ["warning", "Data Gagal Diedit"];
    }
    header("Location: ciri.php");
  }
?>