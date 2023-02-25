<?php 

  require('./database/koneksi.php');
  require('./components/header.php');
  require('./components/menu.php');

  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
      $r = mysqli_fetch_assoc($result);
      $_SESSION['id_user'] = $r['id_user'];
      $_SESSION['username'] = $r['username'];
      $_SESSION['email'] = $r['email'];
      $_SESSION['message'] = ["success", "Berhasil Login"];
      header("Location: admin/index.php");
    } else {
      $_SESSION['message'] = ["warning", "Password atau Username Salah"];
      header("Location: login.php");
    }
  }

  ?>
  <div class="container" id="mainForm">
    <div class="card" style="width: 30%">
      <div class="card-header text-center">
        <h4>Login Admin</h4>
      </div>
      <div class="card-body">
        <form action="login.php" method="POST">
          <div class="mb-3">
            <label for="exampleInputUser" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="exampleInputUser">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword">
          </div>
          <button type="submit" class="btn text-white" name="login">Login</button>
        </form>
      </div>
    </div>
  </div>
  <?php require('./components/footer.php'); ?>
</body>
</html>