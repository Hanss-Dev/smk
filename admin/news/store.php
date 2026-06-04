<?php
require "../../config/database.php";

$title=$_POST['title'];
$slug=strtolower(str_replace(" ","-",$title));
$content=$_POST['content'];
$file=$_FILES['thumbnail']['name'];

move_uploaded_file($_FILES['thumbnail']['tmp_name'],
 "../../uploads/news/".$file);

mysqli_query($conn,"INSERT INTO news VALUES(
 null,'$title','$slug','$content','$file','publish',NOW()
)");

header("Location: index.php");


require __DIR__ . "/../../core/flash.php";

setFlash('success', 'Berita berhasil ditambahkan');
header("Location: index.php");
exit;
