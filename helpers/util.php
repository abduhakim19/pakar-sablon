<?php 
  function kodeGenerator($data, $tipe) {

    $kode = $data['kodeTerbesar'];
    $urutan = (int) substr($kode, 1, 2);
  
    $urutan++;
    switch ($tipe) {
      case 'sablon':
        $huruf = "S";
        break;
      case 'ciri':
        $huruf = "C";
        break;
      case 'rule':
        $huruf = "R";
        break;
      default:
        $huruf = "S";
        break;
    }
    $hasil = $huruf . sprintf("%02s", $urutan);
    return $hasil;
  }

?>