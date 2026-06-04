<?php
require __DIR__ . "/../../config/database.php";
include __DIR__ . "/../layout/header.php";
include __DIR__ . "/../layout/sidebar.php";

// ambil id
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// ambil data pesan
$result = mysqli_query($conn, "SELECT * FROM pesan WHERE id=$id");
$p = mysqli_fetch_assoc($result);

if (!$p) {
    echo "<div class='content-wrapper p-4'>Pesan tidak ditemukan</div>";
    exit;
}

// update status jadi read
mysqli_query($conn, "UPDATE pesan SET status='read' WHERE id=$id");
?>

<div class="content-wrapper p-4">
  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail Pesan</h3>
        </div>

        <div class="card-body">

          <p><strong>Nama:</strong><br>
          <?= htmlspecialchars($p['nama']) ?></p>

          <p><strong>Email:</strong><br>
          <?= htmlspecialchars($p['email']) ?></p>

          <p><strong>Telepon:</strong><br>
          <?= htmlspecialchars($p['telepon']) ?></p>

          <p><strong>Tanggal:</strong><br>
          <?= date('d M Y H:i', strtotime($p['tanggal'])) ?></p>

          <hr>

          <p><strong>Isi Pesan:</strong></p>

          <div style="background:#f8f9fa; padding:15px; border-radius:6px;">
            <?= nl2br(htmlspecialchars($p['pesan'])) ?>
          </div>

          <!-- BUTTON KIRI & KANAN -->
          <div class="d-flex justify-content-between mt-4">

            <!-- KEMBALI (KIRI) -->
            <a href="index.php" class="btn btn-secondary">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <!-- HAPUS (KANAN) -->
            <a href="delete.php?id=<?= $p['id'] ?>"
               onclick="return confirm('Hapus pesan ini?')"
               class="btn btn-danger">
              <i class="fas fa-trash"></i> Hapus
            </a>

          </div>

        </div>
      </div>

    </div>
  </section>
</div>

<?php include __DIR__ . "/../layout/footer.php" ?>