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

    /* ── Nonaktifkan transisi saat restore state dari localStorage ──── */
    body.sidebar-no-transition .main-sidebar,
    body.sidebar-no-transition .main-sidebar * {
      transition: none !important;
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

    .admin-tour-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.55);
      z-index: 1090;
      pointer-events: none;
    }

    .admin-tour-overlay.active {
      display: block;
      pointer-events: auto;
    }

    .admin-tour-highlight {
      display: none;
      position: absolute;
      border: 3px solid #4fc3f7;
      border-radius: 0.75rem;
      box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.35);
      background: transparent;
      pointer-events: none;
      transition: all 0.3s ease;
      z-index: 1095;
    }

    .admin-tour-tooltip {
      display: none;
      position: absolute;
      width: min(320px, calc(100vw - 2rem));
      max-width: 340px;
      background: #ffffff;
      border-radius: 1rem;
      box-shadow: 0 16px 40px rgba(0,0,0,0.15);
      color: #111;
      padding: 1rem;
      z-index: 1110;
      pointer-events: auto;
    }

    .admin-tour-tooltip.active {
      display: block;
    }

    .admin-tour-tooltip-header {
      display: flex;
      justify-content: space-between;
      gap: 0.75rem;
      align-items: flex-start;
      margin-bottom: 0.75rem;
    }

    .admin-tour-tooltip-header h3 {
      margin: 0;
      font-size: 1.05rem;
      font-weight: 700;
    }

    .admin-tour-tooltip-body {
      margin-bottom: 0.9rem;
      line-height: 1.5;
      font-size: 0.95rem;
    }

    .admin-tour-tooltip-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 0.5rem;
      flex-wrap: wrap;
    }

    .admin-tour-tooltip-footer .btn {
      min-width: 90px;
    }

    .admin-tour-close {
      border: none;
      background: transparent;
      color: #333;
      font-size: 1.25rem;
      cursor: pointer;
      line-height: 1;
      padding: 0;
    }
  </style>

  @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  {{-- Terapkan state sidebar SEBELUM render agar tidak ada flash --}}
  <script>
    (function () {
      if (localStorage.getItem('sidebar_collapsed') === 'true') {
        document.body.classList.add('sidebar-collapse');
      }
    })();
  </script>
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

  <div id="admin-tour-overlay" class="admin-tour-overlay" aria-hidden="true">
    <div id="admin-tour-highlight" class="admin-tour-highlight"></div>
    <div id="admin-tour-tooltip" class="admin-tour-tooltip" role="dialog" aria-modal="true" aria-labelledby="admin-tour-title">
      <div class="admin-tour-tooltip-header">
        <h3 id="admin-tour-title">Panduan Admin</h3>
        <button type="button" class="admin-tour-close" aria-label="Tutup panduan">×</button>
      </div>
      <div id="admin-tour-description" class="admin-tour-tooltip-body"></div>
      <div class="admin-tour-tooltip-footer">
        <span id="admin-tour-counter" class="text-muted"></span>
        <div class="btn-group" role="group">
          <button type="button" id="admin-tour-prev" class="btn btn-outline-secondary btn-sm">Sebelumnya</button>
          <button type="button" id="admin-tour-next" class="btn btn-primary btn-sm">Berikutnya</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('assets/adminlte/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/adminlte/dist/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('assets/js/image-modal.js') }}"></script>


  <script>
    $(document).ready(function () {

      // ── Desktop sidebar toggle (bukan data-widget agar tidak konflik) ──────
      $('#sidebar-toggle-desktop').on('click', function (e) {
        e.preventDefault();
        // Gunakan PushMenu AdminLTE untuk toggle collapse
        $('[data-widget="pushmenu"]').first().PushMenu('toggle');

        // Simpan state ke localStorage agar bertahan saat pindah halaman
        var isCollapsed = $('body').hasClass('sidebar-collapse');
        localStorage.setItem('sidebar_collapsed', isCollapsed ? 'true' : 'false');
      });

      // ── Sync state awal AdminLTE dengan localStorage ──────────────────────
      // Jika LocalStorage bilang collapsed, pastikan class sudah ada (sudah di-set
      // oleh inline script di atas), tapi kita trigger event agar AdminLTE sync.
      // Tidak perlu animasi di sini karena transition sudah dimatikan sementara.
      if (localStorage.getItem('sidebar_collapsed') === 'true') {
        // Tambahkan sementara class no-transition agar tidak ada animasi flash
        $('body').addClass('sidebar-no-transition');
        setTimeout(function () {
          $('body').removeClass('sidebar-no-transition');
        }, 50);
      }

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
            const $preview = $('#previewImage');
            $preview
              .attr('src', e.target.result)
              .removeClass('d-none')
              .css('cursor', 'pointer')
              .addClass('preview-image')
              .removeAttr('data-modal-skip');

            // Pastikan image-modal sudah siap, bind langsung supaya langsung bisa diklik
            $preview.off('click.previewModal').on('click.previewModal', function () {
              if (window.ImageModal && typeof window.ImageModal.open === 'function') {
                window.ImageModal.open(this.src, this.alt || 'Preview gambar');
              }
            });
          };
          reader.readAsDataURL(file);
        }
      });

      $(document).on('change', '.bulk-select-all', function () {
        $('.bulk-select-row').prop('checked', this.checked);
      });

      $(document).on('change', '.bulk-select-row', function () {
        const allRows = $('.bulk-select-row').length;
        const checkedRows = $('.bulk-select-row:checked').length;
        $('.bulk-select-all').prop('checked', allRows > 0 && allRows === checkedRows);
      });

      $(document).on('submit', '.bulk-delete-form', function (e) {
        if ($('.bulk-select-row:checked').length === 0) {
          e.preventDefault();
          alert('Pilih minimal satu data untuk dihapus.');
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