<?php
require __DIR__ . "/../../config/database.php";

$id      = (int)$_POST['id'];
$title   = mysqli_real_escape_string($conn,$_POST['title']);
$content = mysqli_real_escape_string($conn,$_POST['content']);
$status  = $_POST['status'];

$slug = strtolower(trim(preg_replace('/[^a-z0-9]+/i','-',$title),'-'));

if($_FILES['thumbnail']['name']){
  $file = time().$_FILES['thumbnail']['name'];
  move_uploaded_file($_FILES['thumbnail']['tmp_name'],"../../uploads/news/".$file);

  mysqli_query($conn,"UPDATE news SET title='$title',slug='$slug',content='$content',thumbnail='$file',status='$status' WHERE id=$id");
}else{
  mysqli_query($conn,"UPDATE news SET title='$title',slug='$slug',content='$content',status='$status' WHERE id=$id");
}

header("Location: index.php");
exit;
