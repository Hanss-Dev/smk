<?php
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../core/flash.php";

// ambil data
$title   = mysqli_real_escape_string($conn, $_POST['title']);
$content = mysqli_real_escape_string($conn, $_POST['content']);
$active  = (int) $_POST['is_active'];

$imageName = null;

// jika upload gambar
if (!empty($_FILES['image']['name'])) {

  $allowed = ['jpg','jpeg','png'];
  $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

  if (!in_array($ext, $allowed)) {
    setFlash('error', 'Format gambar harus jpg, jpeg, atau png');
    header("Location: create.php");
    exit;
  }

  $imageName = time() . '-' . basename($_FILES['image']['name']);
  move_uploaded_file(
    $_FILES['image']['tmp_name'],
    __DIR__ . "/../../uploads/popup/" . $imageName
  );
}

// simpan ke database
mysqli_query($conn, "
  INSERT INTO popup (title,content,image,is_active)
  VALUES ('$title','$content','$imageName','$active')
");

// set notifikasi
setFlash('success', 'Popup berhasil ditambahkan');

// redirect
header("Location: index.php");
exit;
