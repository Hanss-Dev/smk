<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Login Admin | SMK Mitra Industri</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body { background: linear-gradient(135deg, #2563eb, #1e40af); }
    .login-box { width: 380px; }
    .login-logo b { color: #2563eb; }
    .flash-success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; }
    .flash-error   { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 10px 15px; border-radius: 5px; margin-bottom: 10px; }
  </style>
</head>

<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <b>Admin</b>Panel
  </div>

  <div class="card shadow">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Masuk untuk mengelola website</p>

      {{-- Flash Messages --}}
      @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="flash-error">{{ session('error') }}</div>
      @endif

      <form method="post" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
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
            <button type="submit" class="btn btn-primary btn-block">
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
