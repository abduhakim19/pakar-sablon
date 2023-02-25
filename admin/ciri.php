<?php 
  require('../database/koneksi.php');
  require('../helpers/util.php');

  require('./components/header.php');
  require('./components/navbar.php');

  
  $queryKode = "SELECT max(kd_ciri) as kodeTerbesar FROM tb_ciri";
  $resultKode = mysqli_query($conn, $queryKode);
  $dataKode = mysqli_fetch_array($resultKode);
  $kodeSablon = kodeGenerator($dataKode, 'ciri');

  $query = "SELECT * FROM tb_ciri";
  $result = mysqli_query($conn, $query);
  
  $no = 1;
  ?>
    <div id="layoutSidenav">
      <?php require('./components/menu.php'); ?>
      <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-3">Ciri-Ciri Sablon</h3>
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active">Ciri-ciri</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                      <button class=" btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#sablonModal">Tambah</button>
                      <table class="table table-striped table-hover table-bordered" id="tabel-data">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Kode </th>
                            <th>Ciri-ciri</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while($r = mysqli_fetch_array($result)) { ?>         
                            <tr>
                              <td><?= $no ?></td>
                              <td><?= $r['kd_ciri'] ?></td>
                              <td><?= $r['ciri'] ?></td>
                              <td class="aksi">
                                <a href="edit-ciri.php?id=<?=$r['id_ciri']?>" class="btn btn-primary" name="edit">
                                  <i class="fas fa-edit"></i>
                                </a>
                                <a href="proses-ciri.php?id=<?=$r['id_ciri']?>&name=hapus?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus ?');">
                                  <i class="fas fa-trash"></i>
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
            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Ciri-ciri</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="proses-ciri.php" method="POST">
            <div class="modal-body">
              <div class="mb-2">
                <label for="inputKodeCiri" class="col-form-label">Kode Sablon</label>
                <input type="text" class="form-control" id="inputKodeCiri" value="<?=$kodeSablon?>" disabled>
                <input type="hidden" name="inputKodeCiri" value="<?=$kodeSablon?>">
              </div>
              <div class="mb-2">
                <label for="inputCiri" class="col-form-label">Ciri-ciri</label>
                <input type="text" name="inputCiri" class="form-control" id="inputCiri">
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