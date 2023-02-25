<?php 
  require('../database/koneksi.php');
  require('../helpers/util.php');

  require('./components/header.php');
  require('./components/navbar.php');
  ?>
    <div id="layoutSidenav">
      <?php require('./components/menu.php'); ?>
      <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h3 class="mt-3">Dashboard</h3>
                <ol class="breadcrumb mb-3">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active"></li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                      <p>Selamat datang, <?=$_SESSION['username']?> di Sistem Pakar Sablon</p>
                    </div>
                </div>
            </div>
        </main>
        <?php require('./components/footer.php'); ?>
      </div>
    </div>
  </body>
</html>