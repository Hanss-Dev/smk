<?php
require_once __DIR__."/auth.php";
if(!isAdmin()){
  header("Location: /sekolah/admin/login.php");
  exit;
}
