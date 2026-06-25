<?php
require __DIR__ . "/../../core/middleware.php";
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../core/flash.php";

if (!isset($_GET['id'])) {
  setFlash('error', 'ID berita tidak valid');
  header("Location: index.php");
  exit;
}

$id = (int) $_GET['id'];

$q = mysqli_query($conn, "SELECT thumbnail FROM news WHERE id=$id");
$data = mysqli_fetch_assoc($q);

if (!$data) {
  setFlash('error', 'Berita tidak ditemukan');
  header("Location: index.php");
  exit;
}

if (!empty($data['thumbnail'])) {
  $filePath = __DIR__ . "/../../uploads/news/" . $data['thumbnail'];
  if (file_exists($filePath)) {
    unlink($filePath);
  }
}

mysqli_query($conn, "DELETE FROM news WHERE id=$id");

setFlash('success', 'Berita berhasil dihapus');

header("Location: index.php");
exit;
