<?php
require __DIR__ . "/../../config/database.php";

// ambil id & amankan
$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

// hapus data
$query = "DELETE FROM pesan WHERE id=$id";

if (mysqli_query($conn, $query)) {
    header("Location: index.php?success=delete");
} else {
    header("Location: index.php?error=delete");
}

exit;