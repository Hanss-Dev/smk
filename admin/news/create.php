<?php
require __DIR__."/../../config/database.php";
include __DIR__."/../layout/header.php";
include __DIR__."/../layout/sidebar.php";
?>

<div class="content-wrapper">

<section class="content-header">
  <h1>Tambah Berita</h1>
</section>

<section class="content">
<div class="card card-primary">
<div class="card-header">
  <h3 class="card-title">Form Berita</h3>
</div>

<form action="store.php" method="post" enctype="multipart/form-data">
<div class="card-body">

<div class="form-group">
  <label>Judul Berita</label>
  <input type="text" name="title" class="form-control" required>
</div>

<div class="form-group">
  <label>Konten</label>
  <textarea name="content" class="form-control" rows="6"></textarea>
</div>

<?php
$label = "Thumbnail Berita";
$name  = "thumbnail";
include __DIR__."/../partials/dropzone.php";
?>

</div>

<div class="card-footer d-flex justify-content-between">
  <a href="index.php" class="btn btn-secondary">Kembali</a>
  <button class="btn btn-primary btn-simpan">
    <i class="fas fa-save"></i> Simpan
  </button>
</div>

</form>
</div>
</section>
</div>

<?php include __DIR__."/../layout/footer.php"; ?>
