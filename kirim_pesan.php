<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . "/config/database.php";

// pastikan request POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

// ambil data
$nama     = trim($_POST['name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$telepon  = trim($_POST['telepon'] ?? '');
$pesan    = trim($_POST['message'] ?? '');

// validasi kosong
if ($nama === '' || $email === '' || $telepon === '' || $pesan === '') {
    header("Location: index.php?error=1");
    exit;
}

// validasi email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?error=2");
    exit;
}

// validasi nomor telepon (10–15 digit)
if (!preg_match('/^[0-9]{10,15}$/', $telepon)) {
    header("Location: index.php?error=3");
    exit;
}

// amankan input (anti injection basic)
$nama     = mysqli_real_escape_string($conn, $nama);
$email    = mysqli_real_escape_string($conn, $email);
$telepon  = mysqli_real_escape_string($conn, $telepon);
$pesan    = mysqli_real_escape_string($conn, $pesan);

// query insert
$query = "INSERT INTO pesan (nama, email, telepon, pesan, status)
          VALUES ('$nama', '$email', '$telepon', '$pesan', 'unread')";

// eksekusi
if (mysqli_query($conn, $query)) {
    header("Location: index.php?success=1");
    exit;
} else {
    // tampilkan error (biar gak silent fail)
    echo "Database Error: " . mysqli_error($conn);
}