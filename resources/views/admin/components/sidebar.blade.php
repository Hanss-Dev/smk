<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- STICKY: Logo -->
  <div class="ega-sidebar-logo text-center py-3 position-relative">
    <!-- Desktop toggle button (manual JS, bukan data-widget agar tidak konflik) -->
    <a href="#" id="sidebar-toggle-desktop" class="sidebar-toggle-btn text-white position-absolute"
       role="button" style="right: 12px; top: 14px; z-index: 1050;" title="Collapse/Expand Sidebar">
      <i class="fas fa-bars"></i>
    </a>
    <img src="{{ asset('assets/img/logo-mt.png') }}" class="ega-logo-img mb-2" alt="Logo Sekolah"
      style="width: 90px;">
    <div class="ega-logo-text font-weight-bold text-white">
      ADMIN PANEL
    </div>
  </div>

  <!-- SCROLLABLE: Menu -->
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}"
            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>Dashboard</p>
          </a>
        </li>

        @php
          $isKonten = request()->is('admin/news*') || request()->is('admin/highlight*') || request()->is('admin/popup*') || request()->is('admin/alumni*') || request()->is('admin/content-jurusan*');
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
              <a href="{{ route('admin.news.index') }}"
                class="nav-link {{ request()->is('admin/news*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-newspaper text-info"></i>
                <p>Berita</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.highlight.index') }}"
                class="nav-link {{ request()->is('admin/highlight*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-star text-warning"></i>
                <p>Highlight</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.popup.index') }}"
                class="nav-link {{ request()->is('admin/popup*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-bullhorn text-danger"></i>
                <p>Popup</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.alumni.index') }}"
                class="nav-link {{ request()->is('admin/alumni*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-users-cog text-primary"></i>
                <p>Alumni</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.content-jurusan.index') }}"
                class="nav-link {{ request()->is('admin/content-jurusan*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-graduation-cap text-white"></i>
                <p>Content Jurusan</p>
              </a>
            </li>
          </ul>
        </li>

        @php
          $isHalaman = request()->is('admin/podcast*') || request()->is('admin/lab*') || request()->is('admin/safety-riding*');
        @endphp

        <li class="nav-item has-treeview {{ $isHalaman ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ $isHalaman ? 'active' : '' }}">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Kelola Halaman
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.podcast.index') }}"
                class="nav-link {{ request()->is('admin/podcast*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-podcast text-info"></i>
                <p>Podcast</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.lab.index') }}"
                class="nav-link {{ request()->is('admin/lab*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-laptop text-success"></i>
                <p>Lab Komputer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.safety-riding.index') }}"
                class="nav-link {{ request()->is('admin/safety-riding*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-motorcycle text-warning"></i>
                <p>Safety Riding</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.pesan.index') }}"
            class="nav-link {{ request()->is('admin/pesan*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-envelope"></i>
            <p>Pesan Masuk</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
  {{-- /SCROLLABLE --}}

  <div class="ega-sidebar-logout">
    <a href="{{ route('admin.logout') }}"
       class="nav-link logout-link"
       data-confirm-message="Yakin ingin keluar?">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <span class="logout-text">Logout</span>
    </a>
</div>

</aside>
