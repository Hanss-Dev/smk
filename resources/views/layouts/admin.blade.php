<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'Admin Panel') | SMK</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/adminlte.min.css') }}">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" href="{{ asset('assets/img/logo-mt.png') }}" type="image/png">
  @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="ega-sidebar-logo text-center py-3">
      <img
        src="{{ asset('assets/img/logo-mt.png') }}"
        class="ega-logo-img mb-2"
        alt="Logo Sekolah"
        style="width: 90px;">
      <div class="ega-logo-text font-weight-bold text-white">
        ADMIN PANEL
      </div>
    </div>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>Dashboard</p>
            </a>
          </li>

          @php
            $isKonten = request()->is('admin/news*') || request()->is('admin/highlight*') || request()->is('admin/popup*');
          @endphp

          <li class="nav-item has-treeview {{ $isKonten ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $isKonten ? 'active' : '' }}">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Kelola Konten
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.news.index') }}" class="nav-link {{ request()->is('admin/news*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-newspaper text-info"></i>
                  <p>Berita</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.highlight.index') }}" class="nav-link {{ request()->is('admin/highlight*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-star text-warning"></i>
                  <p>Highlight</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.popup.index') }}" class="nav-link {{ request()->is('admin/popup*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-bullhorn text-danger"></i>
                  <p>Popup</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin.pesan.index') }}" class="nav-link {{ request()->is('admin/pesan*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-envelope"></i>
              <p>Pesan Masuk</p>
            </a>
          </li>

          <li class="nav-item mt-3">
            <a href="{{ route('admin.logout') }}" class="nav-link text-danger">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  @yield('content')

  <!-- Footer -->
  <footer class="main-footer text-center">
    <strong>&copy; {{ date('Y') }} SMK Mitra Industri MM2100</strong>
  </footer>

</div>

<!-- Scripts -->
<script src="{{ asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/adminlte/dist/js/adminlte.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function() {
  // Dropzone click trigger
  $(document).on('click', '#dropzone', function(e) {
    // Only trigger if the click wasn't on the file input itself
    if (e.target.id !== 'fileInput') {
      $('#fileInput').click();
    }
  });

  // Prevent file input click from bubbling to dropzone (infinite loop fix)
  $(document).on('click', '#fileInput', function(e) {
    e.stopPropagation();
  });

  // Dropzone drag and drop
  $(document).on('dragover', '#dropzone', function(e) {
    e.preventDefault();
    $(this).addClass('bg-light');
  });

  $(document).on('dragleave', '#dropzone', function(e) {
    e.preventDefault();
    $(this).removeClass('bg-light');
  });

  $(document).on('drop', '#dropzone', function(e) {
    e.preventDefault();
    $(this).removeClass('bg-light');
    
    const files = e.originalEvent.dataTransfer.files;
    if (files.length) {
      const fileInput = document.getElementById('fileInput');
      fileInput.files = files;
      $(fileInput).trigger('change');
    }
  });

  // File input change / preview
  $(document).on('change', '#fileInput', function() {
    const file = this.files[0];
    if (file) {
      $('#dropzone p').text(file.name);
      const reader = new FileReader();
      reader.onload = function(e) {
        $('#previewImage').attr('src', e.target.result).removeClass('d-none');
      }
      reader.readAsDataURL(file);
    }
  });
});
</script>

@if(request()->is('admin/pesan*'))
  @include('admin.pesan.reply-modal')
@endif

@yield('scripts')
</body>
</html>

