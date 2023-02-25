<?php 
  session_start();
  require('../database/koneksi.php');

  if (isset($_POST['simpan'])) {
    $kode = $_POST['inputKodeSablon'];
    $sablon = $_POST['inputSablon'];
    $penjelasan = $_POST['inputPenjelasan'];
    $query = "INSERT INTO `tb_sablon`(`kd_sablon`, `nama_sablon`, `penjelasan`) 
              VALUES ('$kode','$sablon','$penjelasan')";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $_SESSION['message'] = ["success", "Data Berhasil DiSimpan"];
    } else {
      $_SESSION['message'] = ["warning","Data Gagal DiSimpan"];
    }
    header("Location: sablon.php");
  }

  if (isset($_GET['name']) =='hapus') {
    $id = $_GET['id'];
    $query = "DELETE FROM tb_sablon WHERE id_sablon =$id";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $_SESSION['message'] = ["success", "Data Berhasil Dihapus"];
    } else {
      $_SESSION['message'] = ["warning", "Data Gagal Dihapus"];
    }
    header("Location: sablon.php");
  }

  if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $kode = $_POST['inputKodeSablon'];
    $sablon = $_POST['inputSablon'];
    $penjelasan = $_POST['inputPenjelasan'];
    $query = "UPDATE `tb_sablon` SET `kd_sablon`='$kode',`nama_sablon`='$sablon',`penjelasan`='$penjelasan' 
              WHERE `id_sablon`=$id";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $_SESSION['message'] = ["success", "Data Berhasil Diedit"];
    } else {
      $_SESSION['message'] = ["warning", "Data Gagal Diedit"];
    }
    header("Location: sablon.php");
  }
?>