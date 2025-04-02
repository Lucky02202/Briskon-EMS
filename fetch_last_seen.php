<?php

session_start();
include 'db.php'; // or your connection file

if (isset($_SESSION['email_id'])) {

  // $emp_id = $_SESSION['emp_id'];

  $user_id = $_POST['selected_userid'];

  $sql = "SELECT last_seen FROM chat_online_status WHERE emp_id = '$user_id'";
  $result = $conn->query($sql);
  $onlineStatus = "";
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastSeen = strtotime($row['last_seen']);
    $currentTime = time();
    $diff = $currentTime - $lastSeen;
    if ($diff < 10) {
      // User is online
      echo "<span class='text-success small'>● Online</span>";
    } else {
      // User is offline; show last seen
      $formattedLastSeen = date("d M Y, h:i A", $lastSeen);
      echo "<span class='small text-muted'>Last seen: $formattedLastSeen</span>";
    }
  }
}
