<?php
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../core/flash.php";

$id      = (int) $_POST['id'];
$title   = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$active  = (int) $_POST['is_active'];

// ambil data lama
$q = mysqli_query($conn, "SELECT image FROM popup WHERE id=$id");
$old = mysqli_fetch_assoc($q);

// jika upload gambar baru
if (!empty($_FILES['image']['name'])) {

  $allowed = ['jpg','jpeg','png'];
  $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

  if (!in_array($ext, $allowed)) {
    setFlash('error', 'Format gambar harus jpg, jpeg, atau png');
    header("Location: edit.php?id=".$id);
    exit;
  }

  $newName = time() . '-' . basename($_FILES['image']['name']);
  move_uploaded_file(
    $_FILES['image']['tmp_name'],
    __DIR__ . "/../../uploads/popup/" . $newName
  );

  // hapus gambar lama
  if ($old && !empty($old['image'])) {
    $oldFile = __DIR__ . "/../../uploads/popup/" . $old['image'];
    if (file_exists($oldFile)) {
      unlink($oldFile);
    }
  }

  mysqli_query($conn, "
    UPDATE popup SET
      title='$title',
      content='$content',
      image='$newName',
      is_active='$active'
    WHERE id=$id
  ");

} else {

  mysqli_query($conn, "
    UPDATE popup SET
      title='$title',
      content='$content',
      is_active='$active'
    WHERE id=$id
  ");
}

// set notifikasi sukses
setFlash('success', 'Popup berhasil diperbarui');

// redirect
header("Location: index.php");
exit;
