<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
  header("Location: /sekolah/admin/login.php");
  exit;
}

include __DIR__ . "../layout/header.php";
include __DIR__ . "../layout/sidebar.php";

require __DIR__ . "/../config/database.php";

$totalNews      = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM news"))[0];
$publishNews    = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM news WHERE status='publish'"))[0];
$draftNews      = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM news WHERE status='draft'"))[0];
$totalHighlight = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM highlights"))[0];
$totalPopup     = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM popup"))[0];

?>

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <h1>Dashboard</h1>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">

      <div class="row">

        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $totalNews ?></h3>
              <p>Total Berita</p>
            </div>
            <div class="icon"><i class="fas fa-newspaper"></i></div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $publishNews ?></h3>
              <p>Berita Publish</p>
            </div>
            <div class="icon"><i class="fas fa-check"></i></div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $totalHighlight ?></h3>
              <p>Highlight</p>
            </div>
            <div class="icon"><i class="fas fa-star"></i></div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $totalPopup ?></h3>
              <p>Popup</p>
            </div>
            <div class="icon"><i class="fas fa-bullhorn"></i></div>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-8">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Statistik Konten</h3>
            </div>
            <div class="card-body">
              <canvas id="contentChart" height="120"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-success card-outline">
            <div class="card-header">
              <h3 class="card-title">Status Berita</h3>
            </div>
            <div class="card-body">
              <canvas id="newsChart"></canvas>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('contentChart'), {
  type: 'bar',
  data: {
    labels: ['Berita', 'Highlight', 'Popup'],
    datasets: [{
      label: 'Jumlah Konten',
      data: [<?= $totalNews ?>, <?= $totalHighlight ?>, <?= $totalPopup ?>],
      backgroundColor: ['#3b82f6','#facc15','#ef4444'],
      borderRadius: 8
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { display: false }
    }
  }
});

new Chart(document.getElementById('newsChart'), {
  type: 'doughnut',
  data: {
    labels: ['Publish','Draft'],
    datasets: [{
      data: [<?= $publishNews ?>, <?= $draftNews ?>],
      backgroundColor: ['#22c55e','#e5e7eb']
    }]
  },
  options: {
    responsive: true,
    cutout: '70%'
  }
});
</script>

<?php include __DIR__ . "/layout/footer.php"; ?>
