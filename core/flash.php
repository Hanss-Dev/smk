<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function setFlash($type, $message) {
  $_SESSION['flash'] = [
    'type' => $type,   // success | error | warning
    'message' => $message
  ];
}

function showFlash() {
  if (!empty($_SESSION['flash'])) {
    $type = $_SESSION['flash']['type'];
    $msg  = $_SESSION['flash']['message'];

    echo "<div class='flash flash-$type'>$msg</div>";

    unset($_SESSION['flash']);
  }
}
