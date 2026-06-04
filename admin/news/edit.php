<?php
require __DIR__ . "/../../config/database.php";
include __DIR__ . "/../layout/header.php";
include __DIR__ . "/../layout/sidebar.php";

$id = (int) $_GET['id'];
$q  = mysqli_query($conn, "SELECT * FROM news WHERE id=$id");
$n  = mysqli_fetch_assoc($q);

if (!$n) {
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
          <h1>Edit Berita</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php">Berita</a></li>
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
          <div class="card card-primary shadow-sm">

            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-newspaper mr-1"></i> Form Edit Berita
              </h3>
            </div>

            <form action="update.php" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?= $n['id']; ?>">

              <div class="card-body">

                <!-- JUDUL -->
                <div class="form-group">
                  <label>Judul Berita</label>
                  <input
                    type="text"
                    name="title"
                    class="form-control"
                    value="<?= htmlspecialchars($n['title']); ?>"
                    required
                  >
                </div>

                <!-- THUMBNAIL -->
                <div class="form-group">
                  <label>Thumbnail</label>

                  <?php if (!empty($n['thumbnail'])): ?>
                    <div class="mb-2">
                      <img
                        src="/sekolah/uploads/news/<?= htmlspecialchars($n['thumbnail']); ?>"
                        class="img-thumbnail"
                        style="max-height:150px"
                      >
                    </div>
                  <?php endif; ?>

                  <div class="custom-file">
                    <input
                      type="file"
                      name="thumbnail"
                      class="custom-file-input"
                      id="thumbnailInput"
                      accept="image/*"
                    >
                    <label class="custom-file-label" for="thumbnailInput">
                      Ganti thumbnail (opsional)
                    </label>
                  </div>

                  <!-- PREVIEW BARU -->
                  <div class="mt-3">
                    <img
                      id="previewThumbnail"
                      class="img-fluid rounded d-none"
                      style="max-height:200px"
                    >
                  </div>
                </div>

                <!-- KONTEN -->
                <div class="form-group">
                  <label>Konten Berita</label>
                  <textarea
                    name="content"
                    rows="8"
                    class="form-control"
                    required
                  ><?= htmlspecialchars($n['content']); ?></textarea>
                </div>

                <!-- STATUS -->
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="publish" <?= $n['status'] == 'publish' ? 'selected' : ''; ?>>
                      Publish
                    </option>
                    <option value="draft" <?= $n['status'] == 'draft' ? 'selected' : ''; ?>>
                      Draft
                    </option>
                  </select>
                </div>

              </div>

              <!-- FOOTER -->
              <div class="card-footer d-flex justify-content-between">
                <a href="index.php" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-primary btn-simpan">
                  <i class="fas fa-save"></i> Update Berita
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

<!-- PREVIEW THUMBNAIL SCRIPT -->
<script>
document.getElementById('thumbnailInput').addEventListener('change', function(e) {
  const img = document.getElementById('previewThumbnail');
  const file = e.target.files[0];

  if (file) {
    img.src = URL.createObjectURL(file);
    img.classList.remove('d-none');
  }
});
</script>
