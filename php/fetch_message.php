<?php
session_start();
include("db.php");

if (!isset($_SESSION['username'])) {
  exit("You are not logged in");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $sender = $_POST['sender'];
  $receiver = $_POST['receiver'];

  $sql = "SELECT * FROM chat_messages WHERE (sender='$sender' AND receiver='$receiver') OR (sender='$receiver' AND receiver='$sender') ORDER BY created_at";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      if ($row['sender'] == $_SESSION['username']) {
        echo '
        <div class="pt-2 pb-2 d-flex gap-2 align-self-end">
                    <div class="bg-accent-dark h-100 d-flex flex-wrap align-items-center p-1 pe-3 ps-3 rounded-3">'
          . $row["message"] .
          '</div>
                    <img src="./Assets/1.png" alt="profile" class="profile-pic-chat alignn-self-start">
                  </div>
        ';
      } else {
        echo '
      <div class="pt-2 pb-2 d-flex align-items-center gap-2 align-self-start">
                    <img src="./Assets/1.png" alt="profile" class="profile-pic-chat">
                    <div class="bg-accent-dark h-100 d-flex flex-wrap align-items-center p-1 pe-3 ps-3 rounded-3">'
          . $row["message"] .
          '</div>
      </div>
    ';
      }
    }
  }
}
