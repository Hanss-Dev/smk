<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <div class="ega-sidebar-logo text-center py-3">
    <img
      src="../assets/adminlte/dist/img/logo-mt.png"
      class="ega-logo-img mb-2"
      alt="Logo Sekolah"
      style="width: 90px;">
    <div class="ega-logo-text font-weight-bold text-white">
      ADMIN PANEL
    </div>
  </div>

  <div class="sidebar">
    <nav class="mt-2">

      <ul class="nav nav-pills nav-sidebar flex-column"
        data-widget="treeview"
        role="menu"
        data-accordion="false">

        <li class="nav-item">
          <a href="/admin/dashboard.php"
            class="nav-link <?= str_contains($current, 'dashboard') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-chart-line"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <?php
        $isKonten =
          str_contains($current, '/news') ||
          str_contains($current, '/highlight') ||
          str_contains($current, '/popup');
        ?>

        <li class="nav-item has-treeview <?= $isKonten ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isKonten ? 'active' : '' ?>">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>
              Kelola Konten
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="news/index.php"
                class="nav-link <?= str_contains($current, '/news') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-newspaper text-info"></i>
                <p>Berita</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="highlight/index.php"
                class="nav-link <?= str_contains($current, '/highlight') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-star text-warning"></i>
                <p>Highlight</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="popup/index.php"
                class="nav-link <?= str_contains($current, '/popup') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-bullhorn text-danger"></i>
                <p>Popup</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="pesan/index.php"
            class="nav-link <?= str_contains($current, '/pesan') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-envelope"></i>
            <p>Pesan Masuk</p>
          </a>
        </li>

        <li class="nav-item mt-3">
          <a href="logout.php" class="nav-link text-danger">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>