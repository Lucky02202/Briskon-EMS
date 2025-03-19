<?php
$host = "localhost"; // your host
$user = "root";      // your DB username
$pass = "";          // your DB password
$dbname = "briskon_chat";  // replace with your DB name

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM users");
$users = [];

while ($row = $result->fetch_assoc()) {
  $users[] = $row;
}

echo json_encode($users);

$conn->close();
