<?php

session_start();
include("../../php/db.php ");

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
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet"
    href="./chat.css">
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
  <!-- Main Container -->
  <div class="container-fluid d-flex m-0 p-2 vh-100 gap-2 bg-background ">

    <!-- Sidebar -->
    <aside class="custom-20 h-100 bg-main rounded-5 d-flex flex-column align-items-center overflow-auto">
      <img src="./Assets/briskon-logo-1-1.png"
        alt="logo"
        class="img-fluid pt-2"
        style="width: 70%;">
      <hr class="bg-black w-75">

      <!-- List of Sidebar Items -->
      <ul class="list-group list-unstyled gap-2 d-flex flex-column align-items-center w-100 hover fs-6">
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2 align-items-center">
          <i class="fa-solid fa-tv  custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start">Dashboard</p>
        </li>
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2  align-items-center">
          <i class="fa-solid fa-bullhorn custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start">Announcements</p>
        </li>
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2 align-items-center">
          <i class="fa-solid fa-address-book custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start">Employee Directory</p>
        </li>
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2 align-items-center">
          <i class="fa-solid fa-book custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start">My Attendance</p>
        </li>
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2 align-items-center">
          <i class="fa-solid fa-arrow-right-from-bracket custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start">Apply Leave</p>
        </li>
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2 align-items-center">
          <i class="fa-solid fa-clock-rotate-left custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start">Leave History</p>
        </li>
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2 align-items-center">
          <i class="fa-solid fa-chart-pie custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start">My Projects</p>
        </li>
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2 align-items-center">
          <i class="fa-solid fa-table-list custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start">Holiday List</p>
        </li>
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2 align-items-center bg-accent">
          <i class="fa-solid fa-message custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start">Chats</p>
        </li>
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2 align-items-center">
          <i class="fa-solid fa-folder-open custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start">Documents</p>
        </li>
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2 align-items-center">
          <i class="fa-solid fa-circle-user custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start">My Account</p>
        </li>
      </ul>
      <!-- List End -->
    </aside>
    <!-- Sidebar End -->

    <!-- Chat Container -->
    <main class="custom-80 h-100 rounded-5 bg-main">
      <div class="w-100 h-100 rounded-5 p-3 bg-main">
        <div class="container-fluid rounded-4 d-flex h-100 m-0 p-0">

          <!-- Chat Container Sidebar -->
          <div class="chats overflow-auto custom-25 p-2 d-flex flex-column gap-3">

            <!-- Search Bar -->
            <div class="container-fluid position-relative">
              <i class="fa-solid fa-magnifying-glass d-block position-absolute search-icon"></i>
              <input type="text"
                class="form-control ps-3 pe-5 bg-accent border-0"
                placeholder="Search"
                aria-label="Search">
            </div>
            <!-- Search Bar End -->

            <!-- Chat Options -->
            <div class="container-fluid d-flex justify-content-between">
              <div class="box rounded-3 d-flex justify-content-center align-items-center">
                <i class="fa-solid fa-plus"></i>
              </div>
              <div class="box rounded-3 d-flex justify-content-center align-items-center">
                <i class="fa-solid fa-box-archive"></i>
              </div>
              <div class="box rounded-3 d-flex justify-content-center align-items-center">
                <i class="fa-solid fa-users"></i>
              </div>
              <div class="box rounded-3 d-flex justify-content-center align-items-center">
                <i class="fa-solid fa-bars"></i>
              </div>
            </div>
            <!-- Chat Options End -->

            <!-- List of Chats -->
            <div class="chat-users overflow-auto h-100 bg-main d-flex flex-column gap-2"
              id="user-list">

              <!-- Users  -->
              <!-- <div class="user d-flex align-items-center p-2 rounded-3 gap-2"
                onclick="renderChatHeader(this)">
                <div class="user-image custom-20">
                  <img src="../Assets/1.png"
                    alt="user"
                    class="img-fluid rounded-circle"
                    style="min-width: 50px;width: 50px;">
                </div>
                <div class="d-flex flex-column justify-content-between custom-80">
                  <p class="username m-0 p-0 fw-bold ">John Doe</p>
                  <p class="chat-peek m-0 p-0 fs-6 overflow-hidden">Hey! How are you?</p>
                </div>
                <div class="d-flex flex-column align-items-end custom-20">
                  <div class="time">10:20</div>
                  <div class=" messages-count">3</div>
                </div>
              </div> -->

              <?php
              // function to fetch random profile pic
              function getRandomIntInclusive($min, $max)
              {
                $min = ceil($min);
                $max = floor($max);
                return rand($min, $max);
              }

              // Fetch all users except current user
              $sql = "SELECT username from users where username != '$username'";
              $random = getRandomIntInclusive(1, 6);
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $user = $row['username'];
                  $user = ucfirst($user);
                  echo "<div class='user d-flex align-items-center p-2 rounded-3 gap-2'
                onclick='renderChatHeader(this)'>
                <div class='user-image custom-20'>
                  <img src='../Assets/.png'
                    alt='user'
                    class='img-fluid rounded-circle'
                    style='min-width: 50px;width: 50px;'>
                </div>
                <div class='d-flex flex-column justify-content-between custom-80'>
                  <p class='username m-0 p-0 fw-bold '>$user</p>
                  <p class='chat-peek m-0 p-0 fs-6 overflow-hidden'>Hey! How are you?</p>
                </div>
                <div class='d-flex flex-column align-items-end custom-20'>
                  <div class='time'>10:20</div>
                  <div class=' messages-count'>3</div>
                </div>
              </div>";
                }
              }
              ?>
              <!-- Users End -->

            </div>
            <!-- List of Chats End -->

          </div>
          <!-- Chat Container Sidebar End -->

          <!-- Chatbox -->
          <div class="chatbox overflow-auto custom-75 bg-tertiary rounded-4 d-flex flex-column gap-2 border border-1">
            <div class="chatbox-header d-flex align-items-center justify-content-between custom-h-10"
              id="chatbox-header">
              <!-- Dynamic content will be inserted here -->
            </div>

            <div class="chatbox-body custom-h-80">
              <div class="container-fluid d-flex flex-column gap-2"
                id="chatbox-body">
                <!-- Dynamic content will be inserted here -->
              </div>
            </div>
            <div class="chatbox-footer custom-h-10 d-flex align-items-center">
              <div class="container-fluid d-flex align-items-center position-relative"
                id="message-input">

              </div>
            </div>
          </div>
          <!-- Chatbox End -->
        </div>
      </div>
    </main>
    <!-- Chat Container End -->
  </div>

  <script src="https://kit.fontawesome.com/74954d4a6a.js"
    crossorigin="anonymous"></script>
</body>

</html>