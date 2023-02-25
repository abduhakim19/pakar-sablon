<?php 
  require('./database/koneksi.php');
  require('./components/header.php');
  require('./components/menu.php'); 

  $query = "SELECT * FROM tb_sablon";
  $result = mysqli_query($conn, $query);
  $no = 1;
?>

  <div class="container-lg"  style="width: 100%;margin-top: 2rem;margin-bottom: 2rem">
    <div class="card mb-4">
      <div class="card-header">Daftar Jenis Sablon</div>
      <div class="card-body">
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
                <td class="aksi">
                  <a href="detail-jenis.php?id=<?=$r['kd_sablon']?>" class="btn btn-primary" name="edit">
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
    <?php require('./components/footer.php'); ?>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#tabel-data').DataTable();
      });
    </script>
  </body>
</html>