<?php
require __DIR__ . "/../../config/database.php";

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: index.php");
    exit;
}

$query = "DELETE FROM pesan WHERE id=$id";

if (mysqli_query($conn, $query)) {
    header("Location: index.php?success=delete");
} else {
    header("Location: index.php?error=delete");
}

exit;