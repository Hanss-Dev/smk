<?php
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../core/flash.php";

// ambil data
$id     = (int) $_POST['id'];
$title  = mysqli_real_escape_string($conn, $_POST['title']);
$desc   = mysqli_real_escape_string($conn, $_POST['description']);
$active = (int) $_POST['is_active'];

// ambil gambar lama
$q = mysqli_query($conn, "SELECT image FROM highlights WHERE id=$id");
$old = mysqli_fetch_assoc($q);

// jika upload gambar baru
if (!empty($_FILES['image']['name'])) {

  $file = time() . '-' . basename($_FILES['image']['name']);
  move_uploaded_file(
    $_FILES['image']['tmp_name'],
    __DIR__ . "/../../uploads/highlight/" . $file
  );

  // hapus gambar lama
  if ($old && !empty($old['image'])) {
    $oldFile = __DIR__ . "/../../uploads/highlight/" . $old['image'];
    if (file_exists($oldFile)) {
      unlink($oldFile);
    }
  }

  mysqli_query($conn, "
    UPDATE highlights SET
      title='$title',
      description='$desc',
      image='$file',
      is_active='$active'
    WHERE id=$id
  ");

} else {

  mysqli_query($conn, "
    UPDATE highlights SET
      title='$title',
      description='$desc',
      is_active='$active'
    WHERE id=$id
  ");
}

// set notifikasi
setFlash('success', 'Highlight berhasil diperbarui');

// redirect
header("Location: index.php");
exit;
