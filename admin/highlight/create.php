<?php
require __DIR__ . "/../../config/database.php";
include __DIR__ . "/../layout/header.php";
include __DIR__ . "/../layout/sidebar.php";
?>

<div class="content-wrapper">

  <!-- HEADER -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Highlight</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/admin/dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php">Highlight</a></li>
            <li class="breadcrumb-item active">Tambah</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- MAIN CONTENT -->
  <section class="content">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col-md-8">

          <div class="card card-primary shadow-sm">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-star mr-1"></i> Form Highlight
              </h3>
            </div>

            <form action="store.php" method="post" enctype="multipart/form-data">
              <div class="card-body">

                <!-- JUDUL -->
                <div class="form-group">
                  <label>Judul Highlight</label>
                  <input
                    type="text"
                    name="title"
                    class="form-control"
                    placeholder="Masukkan judul highlight"
                    required
                  >
                </div>

                <!-- DESKRIPSI -->
                <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                    placeholder="Tulis deskripsi singkat highlight"
                    required
                  ></textarea>
                </div>

                <!-- GAMBAR -->
                <div class="form-group">
                  <label>Gambar Highlight</label>
                  <div class="custom-file">
                    <input
                      type="file"
                      name="image"
                      class="custom-file-input"
                      id="imageInput"
                      accept="image/*"
                    >
                    <label class="custom-file-label" for="imageInput">
                      Pilih gambar
                    </label>
                  </div>

                  <!-- PREVIEW -->
                  <div class="mt-3">
                    <img id="previewImage" class="img-fluid rounded d-none" style="max-height:200px;">
                  </div>
                </div>

                <!-- STATUS -->
                <div class="form-group">
                  <label>Status</label>
                  <select name="is_active" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                  </select>
                </div>

              </div>

              <!-- FOOTER -->
              <div class="card-footer d-flex justify-content-between">
                <a href="index.php" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-primary btn-simpan">
                  <i class="fas fa-save"></i> Simpan Highlight
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
