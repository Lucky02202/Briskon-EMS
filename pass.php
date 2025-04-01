<?php

session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}

$emp_id = $_SESSION['username'];
$email = $_SESSION['emp_id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  pass
  <?php
  echo "<p>$email<P> <p> $emp_id</p>"
  ?>
</body>

</html>