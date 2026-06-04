<?php
require __DIR__ . "/../../config/database.php";
include __DIR__ . "/../layout/header.php";
include __DIR__ . "/../layout/sidebar.php";

$news = mysqli_query($conn, "SELECT * FROM news ORDER BY created_at DESC");
?>

<div class="content-wrapper p-4">
  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <h3 class="card-title">Kelola Berita</h3>
          <a href="create.php" class="btn btn-primary btn-add">
            <i class="fas fa-plus"></i> Tambah Berita
          </a>
        </div>

        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="bg-light">
              <tr>
                <th width="60">No</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th width="160">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; while($n=mysqli_fetch_assoc($news)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($n['title']) ?></td>
                <td>
                  <span class="badge badge-<?= $n['status']=='publish'?'success':'secondary' ?>">
                    <?= $n['status'] ?>
                  </span>
                </td>
                <td><?= date('d M Y', strtotime($n['created_at'])) ?></td>
                <td>
                  <a href="edit.php?id=<?= $n['id'] ?>" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="delete.php?id=<?= $n['id'] ?>"
                     onclick="return confirm('Hapus berita ini?')"
                     class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

      </div>

    </div>
  </section>
</div>

<?php include __DIR__ . "/../layout/footer.php" ?>
