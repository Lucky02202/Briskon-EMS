<?php

session_start();
include 'db.php'; // or your connection file

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $currentTime = date("Y-m-d H:i:s");
  $conn->query("UPDATE users SET last_seen = '$currentTime' WHERE username = '$username'");
}
