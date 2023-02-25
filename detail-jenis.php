<?php

  require('./database/koneksi.php');
  require('./components/header.php');
  require('./components/menu.php');
  if (isset($_GET['id'])) {
  $kodeSablon = $_GET['id'];

  $querySablon = "SELECT * FROM tb_sablon WHERE kd_sablon='$kodeSablon'";
  $queryCiri = "SELECT * FROM tb_rule 
            INNER JOIN tb_ciri ON tb_ciri.kd_ciri = tb_rule.kd_ciri
            WHERE tb_rule.kd_sablon='$kodeSablon'";
  $resultSablon = mysqli_query($conn, $querySablon);
  $resultCiri = mysqli_query($conn, $queryCiri);
  $r = mysqli_fetch_assoc($resultSablon);

?>

<div class="container mb-4" style="height: auto;">
    <div class="card" style="width: 70%;margin-top: 2rem;">
      <div class="card-header">Hasil Pencarian</div>
        <div class="card-body">
          <div class="mb-2">
            <label for="inputSablon" class="col-form-label">Nama Sablon</label>
            <input type="text" name="inputSablon" class="form-control" id="inputSablon" value="<?=$r['nama_sablon']?>" disabled >
          </div>
          <div class="mb-2">
          <label for="inputCiri" class="col-form-label">CIri-Ciri Sablon</label>
          <?php while($a = mysqli_fetch_array($resultCiri)) { ?>  
            <input type="text" name="inputCiri" class="form-control mt-1" id="inputCiri" value="<?=$a['ciri']?>" disabled >
            <?php } ?>
          </div>
          <div class="mb-2">
            <label for="inputPenjelasan" class="col-form-label">Penjelasan</label>
            <textarea rows="12" name="inputPenjelasan" class="form-control" id="inputPenjelasan" disabled><?=$r['penjelasan']?></textarea>
          </div>
          <a href="jenis.php" class="btn btn-primary">Kembali</a>
        </div>
      </div>
    </div>
  </div>
  <?php require('./components/footer.php'); ?>
<?php  } ?>