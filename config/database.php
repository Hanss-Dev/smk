<?php
$host = "sql305.infinityfree.com";
$user = "if0_40979719";
$pass = "naufalfarhan";
$db   = "if0_40979719_db_sekolah";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die("DB ERROR: " . mysqli_connect_error());
}
