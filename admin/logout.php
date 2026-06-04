<?php
session_start();
require __DIR__ . "/../core/flash.php";

// hapus semua session login
$_SESSION = [];
session_destroy();

// buat session baru untuk flash
session_start();
setFlash('success', 'Anda berhasil logout');

// redirect ke login
header("Location: login.php");
exit;
