<?php
require_once __DIR__ . "/../../core/middleware.php";
require_once __DIR__ . "/../../core/flash.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- ADMINLTE CSS -->
  <link rel="stylesheet" href="/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="/assets/adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!-- NAVBAR -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a href="/admin/logout.php" class="nav-link text-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </li>
  </ul>
</nav>

<!-- SIDEBAR -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- BRAND -->
  <a href="/admin/dashboard.php" class="brand-link text-center">
    <span class="brand-text font-weight-bold">ADMIN PANEL</span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul
        class="nav nav-pills nav-sidebar flex-column"
        data-widget="treeview"
        role="menu"
        data-accordion="false"
      >

        <!-- DASHBOARD -->
        <li class="nav-item">
          <a href="/admin/dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- BERITA -->
        <li class="nav-item">
          <a href="/admin/news/index.php" class="nav-link">
            <i class="nav-icon fas fa-newspaper"></i>
            <p>Berita</p>
          </a>
        </li>

        <!-- HIGHLIGHT -->
        <li class="nav-item">
          <a href="/admin/highlight/index.php" class="nav-link">
            <i class="nav-icon fas fa-star"></i>
            <p>Highlight</p>
          </a>
        </li>

        <!-- POPUP -->
        <li class="nav-item">
          <a href="/admin/popup/index.php" class="nav-link">
            <i class="nav-icon fas fa-bullhorn"></i>
            <p>Popup</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>

<!-- CONTENT -->
<div class="content-wrapper p-3">
  <?php showFlash(); ?>
