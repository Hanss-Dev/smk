<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "smk_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
  die("DB ERROR: " . mysqli_connect_error());
}
