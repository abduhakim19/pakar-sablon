<?php 

  require('./database/koneksi.php');
  require('./components/header.php');
  require('./components/menu.php');

  $queryCiri = "SELECT * FROM tb_ciri";
  $resultCiri = mysqli_query($conn, $queryCiri);

  ?>
  <div class="container-lg"  style="width: 60%;margin-top: 2rem;margin-bottom: 2rem">
    <div class="card">
      <div class="card-header">Pilih Ciri-Ciri Sablon</div>
        <div class="card-body">
          <form action="proses-cari.php" method="POST">
              <div class="list-checkbox overflow-auto"  style="height: 85vh;">
                <?php while($r = mysqli_fetch_array($resultCiri)) { ?>  
                      <div class="p-2 rounded checkbox-form">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="<?=$r['kd_ciri']?>" id="flexCheckDefault-<?=$r['kd_ciri']?>"  name="ciri[]">
                          <label class=" newsletter form-check-label" for="flexCheckDefault-<?=$r['kd_ciri']?>">
                            <?=$r['kd_ciri']?> - <?=$r['ciri']?>
                          </label>
                        </div>     
                    </div>
                <?php } ?>
              </div>
            <button type="submit" class="btn text-white mt-2 btn-primary" name="submit">Cari</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php require('./components/footer.php'); ?>
</body>
</html>