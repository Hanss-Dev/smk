<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <title>@yield('title', 'Admin Panel') | SMK</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/adminlte.min.css') }}">
  <link rel="icon" href="{{ asset('assets/img/logo-mt.png') }}" type="image/png">

  <style>
    /* ── Sidebar scrollable layout ───────────────────────────── */
    .main-sidebar {
      display: flex !important;
      flex-direction: column !important;
      overflow: hidden !important;
    }

    /* Logo — sticky di atas, tidak ikut scroll */
    .ega-sidebar-logo {
      flex-shrink: 0;
      border-bottom: 1px solid rgba(255,255,255,.08);
      transition: padding 0.3s ease;
    }
    .ega-logo-img {
      transition: width 0.3s ease;
    }
    .ega-logo-text {
      transition: opacity 0.2s ease, height 0.3s ease;
      overflow: hidden;
      white-space: nowrap;
    }

    /* Wrapper tengah: mengisi sisa ruang, bisa scroll */
    .sidebar {
      flex: 1 1 0 !important;
      overflow-y: auto !important;
      overflow-x: hidden !important;
      scrollbar-width: thin;
      scrollbar-color: rgba(255,255,255,.15) transparent;
    }
    .sidebar::-webkit-scrollbar { width: 4px; }
    .sidebar::-webkit-scrollbar-track { background: transparent; }
    .sidebar::-webkit-scrollbar-thumb {
      background: rgba(255,255,255,.15);
      border-radius: 2px;
    }

    /* Logout — sticky di bawah, tidak ikut scroll */
    .ega-sidebar-logout {
      flex-shrink: 0;
      border-top: 1px solid rgba(255,255,255,.08);
      padding: 8px 0;
    }
    
    .ega-sidebar-logout .nav-link {
      color: #fc8181 !important;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      padding: .5rem 1rem;
      transition: padding 0.3s ease, justify-content 0.3s ease;
    }
    .ega-sidebar-logout .nav-link:hover {
      background: rgba(255,255,255,.07);
    }
    .ega-sidebar-logout .nav-icon {
      font-size: 1.1rem;
      flex-shrink: 0;
      transition: margin 0.3s ease;
      margin-right: .5rem;
    }
    .ega-sidebar-logout .logout-text {
      transition: opacity 0.2s ease, width 0.3s ease;
      overflow: hidden;
      white-space: nowrap;
    }

    /* Sidebar toggle button style */
    .sidebar-toggle-btn {
      color: rgba(255, 255, 255, 0.7) !important;
      font-size: 1.1rem;
      background: transparent;
      border: none;
      cursor: pointer;
      transition: color 0.2s ease;
    }
    .sidebar-toggle-btn:hover {
      color: #ffffff !important;
    }

    /* Desktop: hide standard top header navbar */
    @media (min-width: 992px) {
      .main-header {
        display: none !important;
      }
      /* Remove top offset since no navbar */
      .content-wrapper,
      .main-footer {
        margin-top: 0 !important;
      }
    }

    /* Mobile: hide the sidebar internal toggle (use navbar hamburger instead) */
    @media (max-width: 991.98px) {
      .sidebar-toggle-btn {
        display: none !important;
      }
    }

    /* ── Sidebar COLLAPSED state (desktop, not hovered) ─────── */
    @media (min-width: 992px) {
      /* Paksa lebar sidebar benar-benar mengecil saat collapse, lalu
         melebar lagi saat di-hover. !important dipakai karena .main-sidebar
         di atas sudah di-override jadi flex custom. */
      .sidebar-mini.sidebar-collapse .main-sidebar {
        width: 4.6rem !important;
        transition: width 0.3s ease !important;
      }
      .sidebar-mini.sidebar-collapse .main-sidebar:hover {
        width: 250px !important;
      }

      /* Sembunyikan SEMUA label teks menu (induk maupun anak grup) */
      .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-link > p {
        display: none !important;
      }

      /* Sembunyikan link INDUK grup (Kelola Konten / Kelola Halaman) —
         anaknya akan langsung ditampilkan flat tanpa grup */
      .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar > .nav-item.has-treeview > .nav-link {
        display: none !important;
      }

      /* Paksa submenu selalu tampil (flatten) & hilangkan indentasi/bg grup */
      .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-treeview {
        display: block !important;
        padding-left: 0 !important;
        margin: 0 !important;
        background: transparent !important;
      }

      /* Samakan tampilan semua ikon (level atas & anak grup) jadi rapi & center */
      .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar > .nav-item > .nav-link,
      .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-treeview > .nav-item > .nav-link {
        display: flex !important;
        justify-content: center;
        align-items: center;
        padding: .65rem 0 !important;
        margin: 2px 8px !important;
        width: calc(100% - 16px) !important;
        border-radius: .35rem !important;
      }
      .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-icon {
        margin-right: 0 !important;
        font-size: 1.15rem;
        width: auto;
      }
    }

    .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .ega-logo-img {
      width: 38px !important;
    }
    .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .ega-logo-text {
      opacity: 0;
      height: 0;
      display: none !important;
    }
    .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .ega-sidebar-logo {
      padding: 8px 0 !important;
    }
    .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .sidebar-toggle-btn {
      display: none !important;
    }
    /* Logout: hide text only, keep icon visible and centered */
    .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .ega-sidebar-logout .logout-text {
      display: none !important;
    }
    .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover)
    .ega-sidebar-logout .nav-icon{
        margin:0 !important;
        width:auto !important;
        font-size:1.2rem;
    }
    .sidebar-mini.sidebar-collapse .main-sidebar:not(:hover) .ega-sidebar-logout .nav-link{
        display:flex !important;
        align-items:center !important;
        justify-content:center !important;

        width:calc(100% - 16px);
        margin:2px 8px;
        padding:.65rem 0 !important;
    }
  </style>

  @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Header Navbar -->
    @include('admin.components.header')

    <!-- Sidebar -->
    @include('admin.components.sidebar')

    <!-- Content Wrapper -->
    @yield('content')

    <!-- Footer -->
    @include('admin.components.footer')

  </div>

  <!-- Scripts -->
  <script src="{{ asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/adminlte/dist/js/adminlte.min.js') }}"></script>


  <script>
    $(document).ready(function () {

      // ── Desktop sidebar toggle (bukan data-widget agar tidak konflik) ──────
      $('#sidebar-toggle-desktop').on('click', function (e) {
        e.preventDefault();
        // Gunakan PushMenu AdminLTE untuk toggle collapse
        $('[data-widget="pushmenu"]').first().PushMenu('toggle');
      });

      // ── Dropzone handlers ────────────────────────────────────────────────
      $(document).on('click', '#dropzone', function (e) {
        if (e.target.id !== 'fileInput') {
          $('#fileInput').click();
        }
      });

      $(document).on('click', '#fileInput', function (e) {
        e.stopPropagation();
      });

      $(document).on('dragover', '#dropzone', function (e) {
        e.preventDefault();
        $(this).addClass('bg-light');
      });

      $(document).on('dragleave', '#dropzone', function (e) {
        e.preventDefault();
        $(this).removeClass('bg-light');
      });

      $(document).on('drop', '#dropzone', function (e) {
        e.preventDefault();
        $(this).removeClass('bg-light');

        const files = e.originalEvent.dataTransfer.files;
        if (files.length) {
          const fileInput = document.getElementById('fileInput');
          fileInput.files = files;
          $(fileInput).trigger('change');
        }
      });

      $(document).on('change', '#fileInput', function () {
        const file = this.files[0];
        if (file) {
          $('#dropzone p').text(file.name);
          const reader = new FileReader();
          reader.onload = function (e) {
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

  <script type="module" src="{{ asset('assets/js/admin.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('assets/js/admin-alerts.js') }}"></script>
  @stack('scripts')
  @yield('scripts')
</body>

</html>