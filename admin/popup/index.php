<?php
require __DIR__ . "/../../config/database.php";
include __DIR__ . "/../layout/header.php";
include __DIR__ . "/../layout/sidebar.php";

/* ambil semua popup */
$popup = mysqli_query($conn, "SELECT * FROM popup ORDER BY id DESC");

/* hitung jumlah popup */
$totalPopup = mysqli_num_rows($popup);
?>

<div class="content-wrapper p-4">
  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">
            <i class="fas fa-bullhorn"></i> Kelola Popup
          </h3>

          <?php if ($totalPopup < 1): ?>
            <!-- TOMBOL TAMBAH POPUP MUNCUL JIKA BELUM ADA -->
            <a href="create.php" class="btn btn-primary btn-add">
              <i class="fas fa-plus"></i> Tambah Popup
            </a>
          <?php else: ?>
            <!-- OPSIONAL: INFO -->
            <span class="badge badge-secondary btn-add">
              Maksimal 1 Popup
            </span>
          <?php endif; ?>
        </div>

        <div class="card-body p-0">
          <table class="table table-bordered table-striped mb-0">
            <thead class="bg-light">
              <tr>
                <th>Judul</th>
                <th>Status</th>
                <th width="120">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($totalPopup > 0): ?>
                <?php while($p = mysqli_fetch_assoc($popup)): ?>
                  <tr>
                    <td><?= htmlspecialchars($p['title']); ?></td>
                    <td>
                      <?php if ($p['is_active']): ?>
                        <span class="badge badge-success">Aktif</span>
                      <?php else: ?>
                        <span class="badge badge-secondary">Nonaktif</span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="edit.php?id=<?= $p['id']; ?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a 
                        href="delete.php?id=<?= $p['id']; ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus popup ini?')"
                      >
                        <i class="fas fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="3" class="text-center text-muted">
                    Belum ada popup
                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </section>
</div>

<?php include __DIR__ . "/../layout/footer.php"; ?>
