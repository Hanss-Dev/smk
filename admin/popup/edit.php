<?php
require __DIR__ . "/../../config/database.php";
include __DIR__ . "/../layout/header.php";
include __DIR__ . "/../layout/sidebar.php";

$id = (int) $_GET['id'];
$q  = mysqli_query($conn, "SELECT * FROM popup WHERE id=$id");
$p  = mysqli_fetch_assoc($q);

if (!$p) {
  header("Location: index.php");
  exit;
}
?>

<div class="content-wrapper">

  <!-- HEADER -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Popup</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php">Popup</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTENT -->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">

        <div class="col-md-10">
          <div class="card card-danger shadow-sm">

            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-bullhorn mr-1"></i> Form Edit Popup
              </h3>
            </div>

            <form action="update.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?= $p['id']; ?>">

              <div class="card-body">

                <!-- JUDUL -->
                <div class="form-group">
                  <label>Judul Popup</label>
                  <input
                    type="text"
                    name="title"
                    class="form-control"
                    value="<?= htmlspecialchars($p['title']); ?>"
                    required
                  >
                </div>

                <!-- KONTEN / LINK -->
                <div class="form-group">
                  <label>Konten / Link / Deskripsi</label>
                  <textarea
                    name="content"
                    rows="4"
                    class="form-control"
                    required
                  ><?= htmlspecialchars($p['content']); ?></textarea>
                </div>

                <!-- GAMBAR -->
                <div class="form-group">
                  <label>Gambar Popup</label>

                  <?php if (!empty($p['image'])): ?>
                    <div class="mb-2">
                      <img
                        src="/sekolah/uploads/popup/<?= htmlspecialchars($p['image']); ?>"
                        class="img-thumbnail"
                        style="max-height:150px"
                      >
                    </div>
                  <?php endif; ?>

                  <div class="custom-file">
                    <input
                      type="file"
                      name="image"
                      class="custom-file-input"
                      id="imageInput"
                      accept="image/*"
                    >
                    <label class="custom-file-label" for="imageInput">
                      Ganti gambar (opsional)
                    </label>
                  </div>

                  <!-- PREVIEW BARU -->
                  <div class="mt-3">
                    <img
                      id="previewImage"
                      class="img-fluid rounded d-none"
                      style="max-height:220px"
                    >
                  </div>
                </div>

                <!-- STATUS -->
                <div class="form-group">
                  <label>Status Popup</label>
                  <select name="is_active" class="form-control">
                    <option value="1" <?= $p['is_active'] ? 'selected' : ''; ?>>
                      Aktif
                    </option>
                    <option value="0" <?= !$p['is_active'] ? 'selected' : ''; ?>>
                      Nonaktif
                    </option>
                  </select>
                </div>

              </div>

              <!-- FOOTER -->
              <div class="card-footer d-flex justify-content-between">
                <a href="index.php" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-danger btn-simpan">
                  <i class="fas fa-save"></i> Update Popup
                </button>
              </div>

            </form>

          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<?php include __DIR__ . "/../layout/footer.php"; ?>

<!-- PREVIEW IMAGE -->
<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
  const img = document.getElementById('previewImage');
  const file = e.target.files[0];

  if (file) {
    img.src = URL.createObjectURL(file);
    img.classList.remove('d-none');
  }
});
</script>
