<?php
session_start();
require __DIR__ . "/../config/database.php";
require __DIR__ . "/../core/flash.php";

if (isset($_SESSION['admin'])) {
  header("Location: dashboard.php");
  exit;
}

if (isset($_POST['login'])) {

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = $_POST['password'];

  $q = mysqli_query($conn,"
    SELECT * FROM admin_users 
    WHERE username='$username'
    LIMIT 1
  ");
  $admin = mysqli_fetch_assoc($q);

  if ($admin && password_verify($password, $admin['password'])) {

    $_SESSION['admin']    = true;
    $_SESSION['admin_id'] = $admin['id'];

    setFlash('success', 'Login berhasil, selamat datang');
    header("Location: dashboard.php");
    exit;

  } else {
    setFlash('error', 'Username atau password salah');
    header("Location: login.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Login Admin | SMK Mitra Industri</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    body {
      background: linear-gradient(135deg, #2563eb, #1e40af);
    }
    .login-box {
      width: 380px;
    }
    .login-logo b {
      color: #2563eb;
    }
  </style>
</head>

<body class="hold-transition login-page">

<div class="login-box">

  <div class="login-logo">
    <b>Admin</b>Panel
  </div>

  <div class="card shadow">
    <div class="card-body login-card-body">

      <p class="login-box-msg">
        Masuk untuk mengelola website
      </p>

      <?php showFlash(); ?>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" name="login" class="btn btn-primary btn-block">
              <i class="fas fa-sign-in-alt"></i> Login
            </button>
          </div>
        </div>
      </form>

    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
