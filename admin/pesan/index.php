<?php
require __DIR__ . "/../../config/database.php";
include __DIR__ . "/../layout/header.php";
include __DIR__ . "/../layout/sidebar.php";

$pesan = mysqli_query($conn, "SELECT * FROM pesan ORDER BY tanggal DESC");
?>

<div class="content-wrapper p-4">
  <section class="content">
    <div class="container-fluid">

      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title">Pesan Masuk</h3>
        </div>

        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover">
            <thead class="bg-light text-center">
              <tr>
                <th width="50">No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th width="300">Pesan</th>
                <th width="100">Status</th>
                <th width="150">Tanggal</th>
                <th width="120">Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php if(mysqli_num_rows($pesan) > 0): ?>
                <?php $no=1; while($p=mysqli_fetch_assoc($pesan)): ?>
                
                <tr class="<?= $p['status']=='unread' ? 'font-weight-bold table-warning' : '' ?>">
                  
                  <td class="text-center"><?= $no++ ?></td>

                  <td>
                    <?php if($p['status']=='unread'): ?>
                      <span class="text-danger">●</span>
                    <?php endif; ?>
                    <?= htmlspecialchars($p['nama']) ?>
                  </td>

                  <td><?= htmlspecialchars($p['email']) ?></td>
                  <td><?= htmlspecialchars($p['telepon']) ?></td>

                  <td>
                    <?php
                      $text = htmlspecialchars($p['pesan']);
                      echo strlen($text) > 50 ? substr($text,0,50).'...' : $text;
                    ?>
                  </td>

                  <td class="text-center">
                    <span class="badge badge-<?= $p['status']=='unread'?'danger':'success' ?>">
                      <?= ucfirst($p['status']) ?>
                    </span>
                  </td>

                  <td class="text-center">
                    <?= date('d M Y H:i', strtotime($p['tanggal'])) ?>
                  </td>

                  <td class="text-center">
                    
                    <a href="read.php?id=<?= $p['id'] ?>" 
                       class="btn btn-info btn-sm" title="Baca Pesan">
                      <i class="fas fa-eye"></i>
                    </a>

                    <a href="delete.php?id=<?= $p['id'] ?>"
                       onclick="return confirm('Hapus pesan ini?')"
                       class="btn btn-danger btn-sm" title="Hapus">
                      <i class="fas fa-trash"></i>
                    </a>

                  </td>

                </tr>

                <?php endwhile; ?>
              <?php else: ?>
                <tr>
                  <td colspan="8" class="text-center text-muted">
                    <i class="fas fa-inbox"></i><br>
                    Belum ada pesan masuk
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

<?php include __DIR__ . "/../layout/footer.php" ?>