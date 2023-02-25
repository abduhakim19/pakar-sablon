<?php 
  require('../database/koneksi.php');
  require('../helpers/util.php');

  require('./components/header.php');
  require('./components/navbar.php');

  
  $queryKode = "SELECT max(kd_sablon) as kodeTerbesar FROM tb_sablon";
  $resultKode = mysqli_query($conn, $queryKode);
  $dataKode = mysqli_fetch_array($resultKode);
  $kodeSablon = kodeGenerator($dataKode, 'sablon');

  $query = "SELECT * FROM tb_sablon";
  $result = mysqli_query($conn, $query);
  
  $no = 1;
  ?>
    <div id="layoutSidenav">
      <?php require('./components/menu.php'); ?>
      <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-3">Jenis Sablon</h3>
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Sablon</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                      <button class=" btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#sablonModal">Tambah</button>
                      <table class="table table-striped table-hover table-bordered" id="tabel-data">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kode </th>
                            <th>Nama</th>
                            <th>Penjelasan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while($r = mysqli_fetch_array($result)) { ?>         
                            <tr>
                              <td><?= $no ?></td>
                              <td><?= $r['kd_sablon'] ?></td>
                              <td><?= $r['nama_sablon'] ?></td>
                              <td><?php echo substr($r['penjelasan'], 0, 100)."..." ?></td>
                              <td class="aksi" style="width: 120px;">
                                <a href="edit-sablon.php?id=<?=$r['id_sablon']?>" class="btn btn-primary" name="edit">
                                  <i class="fas fa-edit"></i>
                                </a>
                                <a href="proses-sablon.php?id=<?=$r['id_sablon']?>&name=hapus?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus ?');">
                                  <i class="fas fa-trash"></i>
                                </a>
                                <a href="detail-sablon.php?id=<?=$r['kd_sablon']?>" class="btn btn-primary" name="edit">
                                  <i class="fa-solid fa-info"></i>
                                </a>
                                </form>
                              </td>
                            </tr>
                          <?php $no = $no+1; } ?>
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </main>
        <?php require('./components/footer.php'); ?>
      </div>
    </div>
    <div class="modal fade" id="sablonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Sablon</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="proses-sablon.php" method="POST">
            <div class="modal-body">
              <div class="mb-2">
                <label for="inputKodeSablon" class="col-form-label">Kode Sablon</label>
                <input type="text" class="form-control" id="inputKodeSablon" value="<?=$kodeSablon?>" disabled>
                <input type="hidden" name="inputKodeSablon" value="<?=$kodeSablon?>">
              </div>
              <div class="mb-2">
                <label for="inputSablon" class="col-form-label">Nama Sablon</label>
                <input type="text" name="inputSablon" class="form-control" id="inputSablon">
              </div>
              <div class="mb-2">
                <label for="inputPenjelasan" class="col-form-label">Penjelasan</label>
                <textarea name="inputPenjelasan" class="form-control" id="inputPenjelasan"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="simpan" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#tabel-data').DataTable();
      });
    </script>
  </body>
</html>