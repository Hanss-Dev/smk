<?php
session_start();
function isAdmin(){
  return isset($_SESSION['admin']);
}
