<?php
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../core/flash.php";

// validasi ID
if (!isset($_GET['id'])) {
  setFlash('error', 'ID highlight tidak valid');
  header("Location: index.php");
  exit;
}

$id = (int) $_GET['id'];

// ambil gambar lama
$q = mysqli_query($conn, "SELECT image FROM highlights WHERE id=$id");
$h = mysqli_fetch_assoc($q);

// hapus file gambar jika ada
if ($h && !empty($h['image'])) {
  $filePath = __DIR__ . "/../../uploads/highlight/" . $h['image'];
  if (file_exists($filePath)) {
    unlink($filePath);
  }
}

// hapus data
mysqli_query($conn, "DELETE FROM highlights WHERE id=$id");

// set notifikasi
setFlash('success', 'Highlight berhasil dihapus');

// redirect
header("Location: index.php");
exit;
