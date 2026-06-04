<?php
require __DIR__ . "/../../core/middleware.php";
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../core/flash.php";

// Validasi ID
if (!isset($_GET['id'])) {
  setFlash('error', 'ID berita tidak valid');
  header("Location: index.php");
  exit;
}

$id = (int) $_GET['id'];

// Ambil data berita
$q = mysqli_query($conn, "SELECT thumbnail FROM news WHERE id=$id");
$data = mysqli_fetch_assoc($q);

// Jika data tidak ditemukan
if (!$data) {
  setFlash('error', 'Berita tidak ditemukan');
  header("Location: index.php");
  exit;
}

// Hapus file thumbnail jika ada
if (!empty($data['thumbnail'])) {
  $filePath = __DIR__ . "/../../uploads/news/" . $data['thumbnail'];
  if (file_exists($filePath)) {
    unlink($filePath);
  }
}

// Hapus data dari database
mysqli_query($conn, "DELETE FROM news WHERE id=$id");

// Set notifikasi sukses
setFlash('success', 'Berita berhasil dihapus');

// Redirect
header("Location: index.php");
exit;
