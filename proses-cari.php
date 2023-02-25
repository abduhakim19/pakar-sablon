<?php
require('./database/koneksi.php');
require('./components/header.php');
require('./components/menu.php');

if(isset($_POST['submit'])){

  function compareIsEqualArray(array $array1,array $array2):bool
  {
    return (array_diff($array1,$array2)==[] && array_diff($array2,$array1)==[]);
  }

  $ciri = $_POST['ciri'];
  //get input
  $rule_input=array();
  for ($i=0; $i < count($ciri) ; $i++){
    array_push($rule_input, $ciri[$i]);
  }

  //get rule
  $queryRule = "SELECT s.kd_sablon, group_concat(d.kd_ciri) kd_ciri
        from tb_sablon s
        left join tb_rule ud on ud.kd_sablon = s.kd_sablon
        left join tb_ciri d on d.kd_ciri = ud.kd_ciri
        group by s.kd_sablon";
  $resultRule=mysqli_query($conn,$queryRule);
  $rule = array();
  while($r = mysqli_fetch_array($resultRule)) {
    array_push($rule, [$r['kd_sablon'], explode(",", $r['kd_ciri'])]);
  }

  $status=false;
  $kodeSablon = '';
  
	for ($i=0; $i < count($rule) ; $i++) {
    $result = compareIsEqualArray($rule_input, $rule[$i][1]);
		if ($result) {
			$status=true;
      $kodeSablon = $rule[$i][0];
		}
	}
	if($status==true){ 
    $querySablon = "SELECT * FROM tb_sablon WHERE kd_sablon='$kodeSablon'";
    $queryCiri = "SELECT * FROM tb_rule 
              INNER JOIN tb_ciri ON tb_ciri.kd_ciri = tb_rule.kd_ciri
              WHERE tb_rule.kd_sablon='$kodeSablon'";
    $resultSablon = mysqli_query($conn, $querySablon);
    $resultCiri = mysqli_query($conn, $queryCiri);
    $r = mysqli_fetch_assoc($resultSablon);
?>
  <!-- Tampil Jika Ada -->
  <div class="container" style="height: 120vh;">
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
            <textarea rows="6" name="inputPenjelasan" class="form-control" id="inputPenjelasan" disabled><?=$r['penjelasan']?></textarea>
          </div>
          <a href="cari2.php" class="btn btn-primary">Kembali</a>
        </div>
      </div>
    </div>
  </div>
<?php	
  }else{
?>
  <div class="container" style="height: 80vh;">
    <div class="card" style="width: 70%;margin-top: 2rem;">
      <div class="card-header">Hasil Pencarian</div>
        <div class="card-body text-center">
          <div class="mb-2">
            <h4>Data Tidak Ditemukan !!!</h4>
          </div>
          <a href="cari2.php" class="btn btn-primary">Kembali</a>
        </div>
      </div>
    </div>
  </div>
<?php
	}
}
?>
  <?php require('./components/footer.php'); ?>
</body>
</html>