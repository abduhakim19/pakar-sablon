<?php 
  session_start();
  require('../database/koneksi.php');
  if ($_POST['name'] == 'simpan') {

    $kodeSablon = $_POST['kodeSablon'];
    $kodeCiri = $_POST['kodeCiri'];

    $query = "INSERT INTO `tb_rule`(`kd_sablon`, `kd_ciri`) 
              VALUES ('$kodeSablon','$kodeCiri')";
    $result = mysqli_query($conn, $query);

    $resultCiri = mysqli_query($conn, "SELECT * FROM tb_rule 
                        inner join tb_ciri ON tb_rule.kd_ciri = tb_ciri.kd_ciri
                        WHERE tb_rule.kd_ciri='$kodeCiri' ORDER BY id_rule DESC LIMIT 1");
    $dataCiri = mysqli_fetch_assoc($resultCiri);
    $data = [
      "id" => $dataCiri['id_rule'],
      "kd_ciri" => $dataCiri['kd_ciri'], 
      "ciri" => $dataCiri['ciri']
    ];

    if ($result) {
      $message = [
        "status" => "success",
        "content" => "Data Berhasil Ditambah",
        "data" => $data
      ];
    } else {
      $message = [
        "status" => "warning",
        "content" => "Data Gagal Ditambah",
        "data" => []
      ];
    }
    echo json_encode($message);
  }

  if ($_POST['name'] == 'cari-sablon') {
    $kodeSablon = $_POST['data'];

    $query = "SELECT * FROM tb_rule 
              inner join tb_sablon ON tb_rule.kd_sablon = tb_sablon.kd_sablon
              inner join tb_ciri ON tb_rule.kd_ciri = tb_ciri.kd_ciri
              WHERE tb_rule.kd_sablon='$kodeSablon'";
    $result = mysqli_query($conn, $query);
    $data = [];
    while($r = mysqli_fetch_array($result)) {
      $data[] = [
        "id" => $r['id_rule'],
        "ciri" => $r['ciri'],
        "kd_ciri" => $r['kd_ciri'],
      ];
    }
    if (count($data) <= 0) {
      $data = [];
    }
    echo json_encode($data);
  }

  if ($_POST['name'] =='hapus') {
    $id = $_POST['id'];
    $query = "DELETE FROM tb_rule WHERE id_rule =$id";
    $result = mysqli_query($conn, $query);
    if ($result) {
      $message = [
        "status" => "success",
        "content" => "Data Berhasil Dihapus"
      ];
    } else {
      $message = [
        "status" => "warning",
        "content" => "Data Gagal Dihapus"
      ];
    }
    echo json_encode($message);
  }

  if ($_POST['name']=='wow') {
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