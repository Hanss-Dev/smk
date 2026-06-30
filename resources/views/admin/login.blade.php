<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Login Admin | SMK Mitra Industri</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('assets/img/logo-mt.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('assets/css/login-admin-style.css') }}">
</head>

<body>

<div class="login-wrapper">

  {{-- ===== LEFT PANEL ===== --}}
  <div class="login-left">
    <div class="logo-wrapper">
      {{-- Replace src with your actual logo path --}}
      <img src="{{ asset('assets/img/logo-mt.png') }}" alt="Logo SMK Cibitung 1">
    </div>
    <div class="app-title">
      <h1>ADMIN LOGIN</h1>
      <p>SMK MITRA INDUSTRI</p>
    </div>
  </div>

  {{-- ===== RIGHT PANEL ===== --}}
  <div class="login-right">
    <div class="login-form-container">

      <div class="login-greeting">
        <h2>
          Silahkan Login Sesuai Akun Anda
        </h2>
      </div>

      {{-- Flash Messages --}}
      @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="flash-error">{{ session('error') }}</div>
      @endif

      <form method="post" action="{{ route('admin.login.post') }}">
        @csrf

        {{-- Username --}}
        <div class="login-form-group">
          <label for="username">Username</label>
          <div class="login-input-wrapper">
            <svg class="login-input-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
            </svg>
            <input type="text" id="username" name="username"
                   placeholder="Masukkan username"
                   value="{{ old('username') }}" required>
          </div>
        </div>

        {{-- Password --}}
        <div class="login-form-group">
          <label for="password">Password</label>
          <div class="login-input-wrapper">
            <svg class="login-input-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
            </svg>
            <input type="password" id="password" name="password"
                   placeholder="Masukkan password" required>
            <span class="login-eye-toggle" onclick="togglePass()" title="Tampilkan / Sembunyikan">
              <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                   viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </span>
          </div>
        </div>

        {{-- Submit --}}
        <button type="submit" class="btn-login">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
          </svg>
          Masuk
        </button>

      </form>

      <p class="login-date" id="today-date"></p>

    </div>
  </div>

</div>

{{-- Scripts --}}
<script>
  // Toggle password visibility
  function togglePass() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('eye-icon');
    if (input.type === 'password') {
      input.type = 'text';
      icon.style.color = '#4f46e5';
    } else {
      input.type = 'password';
      icon.style.color = '';
    }
  }

  (function() {
    const opts = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
    const date = new Date().toLocaleDateString('en-GB', opts);
    document.getElementById('today-date').textContent = date;
  })();
</script>
</body>
</html>