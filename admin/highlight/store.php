<?php
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../core/flash.php";

// ambil data
$title  = mysqli_real_escape_string($conn, $_POST['title']);
$desc   = mysqli_real_escape_string($conn, $_POST['description']);
$active = (int) $_POST['is_active'];

// upload gambar
$file = $_FILES['image']['name'];
move_uploaded_file(
  $_FILES['image']['tmp_name'],
  __DIR__ . "/../../uploads/highlight/" . $file
);

// simpan ke database
mysqli_query($conn, "
  INSERT INTO highlights (title,description,image,is_active,created_at)
  VALUES ('$title','$desc','$file','$active',NOW())
");

// set notifikasi
setFlash('success', 'Highlight berhasil ditambahkan');

// redirect
header("Location: index.php");
exit;
