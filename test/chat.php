<?php

session_start();
include("../php/db.php");

if (!isset($_SESSION['username'])) {
  header("Location: ../php/login.php");
  exit();
}

$username = $_SESSION['username'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../main.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous">
  <script defer
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</head>

<body>
  <div class="container-fluid w-100 bg-accent vh-100 m-0 p-2 d-flex flex-column">
    <nav class="p-2 d-flex justify-content-between align-items-center w-100">
      <img src="../Assets/briskon-logo-1-1.png" class="custom-10" alt="logo">
      <a class="text-decoration-none pe-3 ps-3 p-2 text-white fw-bold bg-button rounded-3" href="../php/logout.php">logout</a>
    </nav>
    <p class="text-center fs-4 fw-bold">Welcome <?php echo ucfirst($username) ?>!</p>

    <main class="container-fluid bg-main rounded-5 w-100 h-100 overflow-h d-flex p-2">
      <aside class="user-list sidebar custom-20 rounded-5 bg-secondary p-2">
        <div class="custom-h-10 text-center fs-5 text-white">
          select a User to chat
        </div>
        <div class="text-center d-flex overflow-auto flex-column gap-2">
          <ul class="list-unstyled">
            <?php
            // Fetch all users except current user
            $sql = "SELECT username from users where username != '$username'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $user = $row['username'];
                $user = ucfirst($user);
                echo "<li class='p-2 mt-2 mb-2 bg-accent fs-6 fw-semibold'><a class='text-decoration-none text-black' href=chat.php?user=$user'>$user</a></li>";
              }
            }
            ?>
          </ul>
        </div>
      </aside>
      <aside class="right-sidebar">

      </aside>
    </main>

  </div>
</body>

</html>