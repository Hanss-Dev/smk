<?php
require __DIR__ . "/../../core/middleware.php";
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../core/flash.php";

// validasi ID
if (!isset($_GET['id'])) {
  setFlash('error', 'ID popup tidak valid');
  header("Location: index.php");
  exit;
}

$id = (int) $_GET['id'];

// ambil gambar lama
$q = mysqli_query($conn, "SELECT image FROM popup WHERE id=$id");
$p = mysqli_fetch_assoc($q);

// hapus file gambar jika ada
if ($p && !empty($p['image'])) {
  $filePath = __DIR__ . "/../../uploads/popup/" . $p['image'];
  if (file_exists($filePath)) {
    unlink($filePath);
  }
}

// hapus data popup
mysqli_query($conn, "DELETE FROM popup WHERE id=$id");

// set notifikasi sukses
setFlash('success', 'Popup berhasil dihapus');

// redirect
header("Location: index.php");
exit;
