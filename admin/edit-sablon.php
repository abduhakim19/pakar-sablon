<?php 
  if (isset($_GET['id'])) {
    require('../database/koneksi.php');
    require('./components/header.php');
    require('./components/navbar.php');

    $id = $_GET['id'];
    $query = "select * from tb_sablon where id_sablon=".$id;
    $result = mysqli_query($conn, $query);
    while($r = mysqli_fetch_array($result)) {
        $id = $r['id_sablon'];
        $kode = $r['kd_sablon']; 
        $nama = $r['nama_sablon']; 
        $penjelasan = $r['penjelasan'];
    }
?>
  <div id="layoutSidenav">
    <?php require('./components/menu.php'); ?>
    <div id="layoutSidenav_content">
      <main>
          <div class="container-fluid px-4">
              <h3 class="mt-3">Edit Jenis Sablon</h3>
              <ol class="breadcrumb mb-3">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active">Sablon</li>
              </ol>
              <div class="card mb-4 p-3">
              <form action="proses-sablon.php" method="POST">
                <div class="mb-2 col-5">
                  <label for="inputKodeSablon" class="col-form-label">Kode Sablon</label>
                  <input type="text" class="form-control" id="inputKodeSablon" value="<?=$kode?>" disabled>
                  <input type="hidden" name="inputKodeSablon" value="<?=$kode?>">
                  <input type="hidden" name="id" value="<?=$id?>">
                </div>
                <div class="mb-2 col-5">
                  <label for="inputSablon" class="col-form-label">Nama Sablon</label>
                  <input type="text" name="inputSablon" class="form-control" id="inputSablon" value="<?=$nama?>">
                </div>
                <div class="mb-2 col-6">
                  <label for="inputPenjelasan" class="col-form-label">Penjelasan</label>
                  <textarea name="inputPenjelasan" class="form-control" id="inputPenjelasan"><?=$penjelasan?></textarea>
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