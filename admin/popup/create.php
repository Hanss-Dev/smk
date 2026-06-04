<?php
require __DIR__ . "/../../config/database.php";
include __DIR__ . "/../layout/header.php";
include __DIR__ . "/../layout/sidebar.php";
?>

<div class="content-wrapper p-4">
<form action="store.php" method="post" enctype="multipart/form-data">
<input name="title" class="form-control" placeholder="Judul">

<textarea name="content" class="form-control" placeholder="Konten / Link"></textarea>

<input type="file" name="image" class="form-control">

<select name="is_active" class="form-control">
<option value="1">Aktif</option>
<option value="0">Nonaktif</option>
</select>

<button class="btn btn-primary mt-2 btn-simpan">Simpan</button>
</form>
</div>

<?php require __DIR__ . "/../partials/footer.php"; ?>
