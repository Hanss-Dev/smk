<?php
require __DIR__ . "/../../config/database.php";
include __DIR__ . "/../layout/header.php";
include __DIR__ . "/../layout/sidebar.php";

$hl = mysqli_query($conn, "SELECT * FROM highlights ORDER BY id DESC");
?>

<div class="content-wrapper p-4">
  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h3 class="card-title">Kelola Highlight</h3>
          <a href="create.php" class="btn btn-primary btn-add">
            <i class="fas fa-plus"></i> Tambah Highlight
          </a>
        </div>

        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th>Judul</th>
              <th>Status</th>
              <th width="140">Aksi</th>
            </tr>
            <?php while($h=mysqli_fetch_assoc($hl)): ?>
            <tr>
              <td><?= htmlspecialchars($h['title']) ?></td>
              <td><?= $h['is_active']?'Aktif':'Nonaktif' ?></td>
              <td>
                <a href="edit.php?id=<?= $h['id'] ?>" class="btn btn-warning btn-sm">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="delete.php?id=<?= $h['id'] ?>" class="btn btn-danger btn-sm">
                  <i class="fas fa-trash"></i>
                </a>
              </td>
            </tr>
            <?php endwhile; ?>
          </table>
        </div>
      </div>

    </div>
  </section>
</div>

<?php include __DIR__ . "/../layout/footer.php"; ?>
