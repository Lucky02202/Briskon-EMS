<?php

session_start();
include('db.php');
if (!isset($_SESSION['username'])) {
  exit("you are not logged in.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $sender = $conn->real_escape_string($_POST['sender']);
  $receiver = $conn->real_escape_string($_POST['receiver']);
  $message = $conn->real_escape_string($_POST['message']);

  $sql = "INSERT INTO chat_messages (sender, receiver, message) VALUES ('$sender', '$receiver', '$message')";
  // $conn->query($sql);

  if ($conn->query($sql) === TRUE) {
    echo "Inserted";
  } else {
    echo "Error: " . $conn->error;
  }
  $conn->close();
}
