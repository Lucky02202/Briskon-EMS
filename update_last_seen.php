<?php

session_start();
include 'db.php'; // or your connection file

if (isset($_SESSION['email_id'])) {
  $emp_id = $_SESSION['emp_id'];
  $currentTime = date("Y-m-d H:i:s");

  // Check if emp_id exists in chat_online_status
  $sql = "SELECT emp_id FROM chat_online_status WHERE emp_id = '$emp_id'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Employee exists, update last_seen
    $conn->query("UPDATE chat_online_status SET last_seen = '$currentTime' WHERE emp_id = '$emp_id'");
  } else {
    // Employee does not exist, insert new record
    $conn->query("INSERT INTO chat_online_status (emp_id, last_seen) VALUES ('$emp_id', '$currentTime')");
  }
}
