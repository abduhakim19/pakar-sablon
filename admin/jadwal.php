<?php 
  require('../database/koneksi.php');
  require('./components/header.php');
  require('./components/navbar.php');

  $query = "select * from jadwal";
  $result = mysqli_query($conn, $query);
  $no = 1;
  ?>
  <body>
    <div class="container">
      <?php require('./components/menu.php'); ?>
      <div class="content">
        <div class="content__title">
          <p>Jadwal Keberangkatan</p>
        </div>
        <div class="content__main">
          <button class="btn-input">Tambah Data</button>
          <table class="table-data">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Polisi</th>
                <th>Asal</th>
                <th>Tujuan</th>
                <th>Jam Berangkat</th>
                <th>Kursi</th>
                <th>Harga</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php while($r = mysqli_fetch_array($result)) { ?>         
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $r['nomor_kendaraan'] ?></td>
                  <td><?= $r['kota_asal'] ?></td>
                  <td><?= $r['kota_tujuan'] ?></td>
                  <td><?= date('H:i', strtotime($r['waktu_berangkat'])) ?></td>
                  <td><?= $r['jumlah_kursi'] ?></td>
                  <td><?= $r['harga'] ?></td>
                  <td>
                    <a href="edit-jadwal.php?id=<?=$r['nomor_kendaraan']?>" class="btn-edit" name="edit">
                      <i class="fas fa-edit"></i>
                    </a> | 
                    <a href="proses-jadwal.php?id=<?=$r['nomor_kendaraan']?>&name=hapus?>" class="btn-delete" onclick="return confirm('Yakin menghapus ?');">
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
      <div class="backdrop hide-modal">
        <div class="modal">
          <div class="modal__title">
            <p>Tambah Data Jadwal</p>
            <button id="clode-modal" class="close-modal"><i class="fas fa-times"></i></button>
          </div>
          <div class="modal__main">
            <div class="form__input">
              <form action="proses-jadwal.php" method="POST">
                <div class="input__group">
                  <label>Nomor Kendaraan</label>
                  <input type="text" name="no_kendaraan" class="input-nama" placeholder="Nomor Kendaraan">
                </div>
                <div class="input__group">
                  <label>Kota Asal</label>
                  <input type="text" name="kota_asal" class="input-nama" placeholder="Kota Asal">
                </div>
                <div class="input__group">
                  <label>Kota Tujuan</label>
                  <input type="text" name="kota_tujuan" class="input-nama" placeholder="Kota Tujuan">
                </div>
                <div class="input__group">
                  <label>Waktu Berangkat</label>
                  <input type="time" name="waktu_berangkat" class="input-nama" placeholder="Waktu Berangkat">
                </div>
                <div class="input__group">
                  <label>Jumlah Kursi</label>
                  <input type="text" name="jumlah_kursi" class="input-nama" placeholder="Jumlah Kursi">
                </div>
                <div class="input__group">
                  <label>Harga</label>
                  <input type="text" name="harga" placeholder="Harga" class="input-noKendaraan">
                </div>
                <div class="simpan__group">
                  <input type="submit" name="simpan" class="btn-simpan" value="Simpan"/>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      const closeModal = document.querySelector('.close-modal');
      const backdrop = document.querySelector('.backdrop');
      const btnTambah = document.querySelector('.btn-input');

      btnTambah.addEventListener('click', () => {
        backdrop.classList.remove("hide-modal");
      });

      closeModal.addEventListener('click', () => {
        backdrop.classList.add("hide-modal");
      });
    </script>
  </body>
</html>