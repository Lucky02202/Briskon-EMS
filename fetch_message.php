<?php
session_start();
include("db.php");

if (!isset($_SESSION['email_id'])) {
  exit("You are not logged in");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $sender = $_POST['sender'];
  $receiver = $_POST['receiver'];

  $sql = "SELECT * FROM chat_messages WHERE (sender='$sender' AND receiver='$receiver') OR (sender='$receiver' AND receiver='$sender') ORDER BY created_at";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      if ($row['sender'] == $_SESSION['emp_id']) {
        echo '
        <div class=" d-flex gap-2 align-self-end bg-accent-dark rounded-3 p-1 ps-2">
          <div class="h-100 d-flex flex-wrap align-items-center ">' . $row["message"] . '</div>
          <div style="font-size: 8px !important; color:gray; align-self:end;">' . date("H:i", strtotime($row["created_at"])) . '</div>  
          <!-- <img src="./Assets/1.png" alt="profile" class="profile-pic-chat alignn-self-start"> --!>
        </div>';
      } else {
        echo '
      <div class=" d-flex gap-2 align-self-start bg-accent-dark rounded-3 p-1 ps-2">
      <div class="h-100 d-flex flex-wrap align-items-center ">' . $row["message"] . '</div>
        <div style="font-size: 8px !important; color:gray; align-self:end;">' . date("H:i", strtotime($row["created_at"])) . '</div>  
          <!-- <img src="./Assets/1.png" alt="profile" class="profile-pic-chat alignn-self-start"> --!>
      </div>';
      }
    }
  }

  $updateReadMsgs = "UPDATE chat_messages SET is_read = 1  WHERE (sender='$sender' AND receiver='$receiver')";
  $conn->query($updateReadMsgs);
}
