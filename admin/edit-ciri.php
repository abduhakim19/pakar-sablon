<?php 
  if (isset($_GET['id'])) {
    require('../database/koneksi.php');
    require('./components/header.php');
    require('./components/navbar.php');

    $id = $_GET['id'];
    $query = "select * from tb_ciri where id_ciri=".$id;
    $result = mysqli_query($conn, $query);
    while($r = mysqli_fetch_array($result)) {
        $id = $r['id_ciri'];
        $kode = $r['kd_ciri']; 
        $ciri = $r['ciri']; 
    }
?>
  <div id="layoutSidenav">
    <?php require('./components/menu.php'); ?>
    <div id="layoutSidenav_content">
      <main>
          <div class="container-fluid px-4">
              <h3 class="mt-3">Edit Ciri-ciri Sablon</h3>
              <ol class="breadcrumb mb-3">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active">Ciri-ciri</li>
              </ol>
              <div class="card mb-4 p-3">
              <form action="proses-ciri.php" method="POST">
                <div class="mb-2 col-5">
                  <label for="inputKodeCiri" class="col-form-label">Kode Ciri-Ciri</label>
                  <input type="text" class="form-control" id="inputKodeCiri" value="<?=$kode?>" disabled>
                  <input type="hidden" name="inputKodeCiri" value="<?=$kode?>">
                  <input type="hidden" name="id" value="<?=$id?>">
                </div>
                <div class="mb-2 col-5">
                  <label for="inputCiri" class="col-form-label">Ciri-ciri</label>
                  <input type="text" name="inputCiri" class="form-control" id="inputCiri" value="<?=$ciri?>">
                </div>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
              </form>
              </div>
          </div>
        </main>
        <?php require('./components/footer.php'); ?>
      </div>
    </div>
  </body>
</html>
<?php } ?>