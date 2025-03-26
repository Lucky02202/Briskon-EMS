<?php
session_start();
include("./db.php");

if (!isset($_SESSION['username'])) {
  header("Location: ./login.php");
  exit();
}

$username = $_SESSION['username'];
$selectedUser = "";


if (isset($_GET['user'])) {
  $selectedUser = $_GET['user'];
  $number = $_GET['num'];
  $selectedUser = mysqli_real_escape_string($conn, $selectedUser);
  $showchatbox = true;
} else {
  $showchatbox = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <script defer src="bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js"></script>
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
        <li class="p-2 w-75 rounded-4 fw-bold d-flex gap-2 align-items-center dropdown">
          <i class="fa-solid fa-circle-user custom-10"></i>
          <p class="m-0 p-0 custom-90 text-start" id='chatbox-options' data-bs-toggle='dropdown' aria-expanded='false'>My Account</p>
          <ul class='dropdown-menu' aria-labelledby='chatbox-options'>
            <li><button class='dropdown-item'>Close chat</button></li>
            <li><a class='dropdown-item' class='btn' href='logout.php'>Logout</a></li>
          </ul>
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
            <div class="container-fluid d-flex justify-content-between position-relative">
              <!-- 
              <div class="box rounded-3 d-flex justify-content-center align-items-center " id="user-list-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-plus"></i>
                <ul class="dropdown-user-list dropdown-menu custom-90 bg-main p-0 m-0 vh-75 hide-scrollbar p-1" aria-labelledby="user-list-dropdown" style="max-height: 60vh; overflow: auto;">
                  php code for dropdown
                  php
                  $sql = "SELECT username from users where username != '$username' order by username";
                  $random = getRandomIntInclusive(1, 6);
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $randomNumber = getRandomIntInclusive(1, 6);
                      $user = $row['username'];
                      $user = ucfirst($user);
                      echo "
                        <li class='user-list-dropdown-item w-100 bg-accent user-list-item mb-1'>
                          <div class='d-flex gap-1 align-items-center p-1'>
                            <div class='user-image custom-20 p-1'>
                              <img src='Assets/1.png'
                                alt='user'
                                class='img-fluid rounded-circle'
                                style='width: 100%; height: 100%; object-fit: cover; /* Or use 'contain' if you don't want cropping */ display: block;'>
                            </div>
                            <div class='d-flex flex-column justify-content-between custom-80'>
                              <p class='username m-0 p-0 fw-bold '>$user</p>
                            </div>
                          </div>
                        </li>";
                    }
                  }
                  ?>
                </ul>
              </div>
               -->
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
              <?php
              // function to fetch random profile pic
              function getRandomIntInclusive($min, $max)
              {
                $min = ceil($min);
                $max = floor($max);
                return rand($min, $max);
              }
              // Fetch all users except current user
              $sql = "SELECT username from users where username != '$username' order by username";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $randomNumber = getRandomIntInclusive(1, 6);
                  $user = $row['username'];
                  $user = ucfirst($user);

                  // Fetch the latest message between the current user and this user
                  $latestMsgQuery = "SELECT message FROM chat_messages 
                      WHERE (sender='$username' AND receiver='$user') 
                          OR (sender='$user' AND receiver='$username') 
                        ORDER BY id DESC LIMIT 1";
                  $msgResult = $conn->query($latestMsgQuery);
                  $latestMessage = ($msgResult->num_rows > 0) ? $msgResult->fetch_assoc()['message'] : " ";
                  if ($msgResult->num_rows > 0) {
                  }
                  echo "
                    <a class='text-reset text-decoration-none' href='chat.php?user=$user&num=$randomNumber'>
                      <div class='user d-flex align-items-center p-2 rounded-3 gap-2 h-100'>
                        <div class='user-image custom-20'>
                            <img src='./Assets/$randomNumber.png' alt='user' class='img-fluid rounded-circle profile-pic'>
                        </div>
                        <div class='d-flex flex-column justify-content-between custom-60 h-100'>
                          <p class='username m-0 p-0 fw-bold '>$user</p>
                          <p class='chat-peek m-0 p-0 fs-6 overflow-hidden text-black-50'>$latestMessage</p>
                        </div>
                        <div class='d-flex flex-column align-items-end justify-content-between custom-20 h-100'>
                          <div class=' messages-count'>3</div>
                          <div class='chat-time2'>11:20</div>
                        </div>
                      </div>
                    </a>";
                }
              }
              ?>
              <!-- Users End -->
            </div>
            <!-- List of Chats End -->
          </div>
          <!-- Chat Container Sidebar End -->

          <!-- Chatbox -->
          <div class="chatbox overflow-auto custom-75 bg-tertiary rounded-4 d-flex flex-column border gap-2   border-1" id="chatbox">
            <?php if ($showchatbox): ?>
              <!-- Chatbox header -->
              <div class="chatbox-header d-flex align-items-center justify-content-between custom-h-10"
                id="chatbox-header">
                <?php
                $sql = "SELECT last_seen FROM users WHERE username = '$selectedUser'";
                $result = $conn->query($sql);
                $onlineStatus = '';
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  $lastSeen = strtotime($row['last_seen']);
                  $currentTime = time();
                  $diff = $currentTime - $lastSeen;
                  if ($diff < 10) {
                    // User is online
                    $onlineStatus = "<span class='text-success small'>● Online</span>";
                  } else {
                    // User is offline; show last seen
                    $formattedLastSeen = date("d M Y, h:i A", $lastSeen);
                    $onlineStatus = "<span class='small text-muted'>Last seen: $formattedLastSeen</span>";
                  }
                }
                echo
                "<div class='d-flex justify-content-between align-items-center w-100 gap-2 p-2 bg-accent'>
                    <div class='d-flex align-items-center gap-3'>
                      <img src='./Assets/$number.png' class='profile-pic' alt='profile'>
                      <div>
                        <p class='m-0 fw-bold'>$selectedUser</p>
                        
                        $onlineStatus
                      </div>
                    </div>
                    <div class='pe-3 ps-3 dropdown'>
                      <div class='chatbox-vertical p-1 pt-2 pb-2 rounded-2' id='chatbox-options' data-bs-toggle='dropdown' aria-expanded='false'>
                        <i class='fa-solid fa-xl fa-ellipsis-vertical pe-3 ps-3'></i>
                      </div>
                      <ul class='dropdown-menu' aria-labelledby='chatbox-options'>
                        <li><button class='dropdown-item' onclick='hideChatBox()'>Close chat</button></li>
                        <li><a class='dropdown-item' class='btn' href='#'>Clear Chat</a></li>
                      </ul>
                    </div>
                  </div>
                  "
                ?>
              </div>
              <!-- Chatbox body -->
              <div class="chatbox-body custom-h-80 d-flex justify-content-center align-items-center ps-2 pe-2 p-1" id="chatbox-body">
                <div class="container-fluid d-flex flex-column gap-2 h-100  overflow-auto hide-scrollbar" id="chatbox-body-dispMsg">

                  <!-- Dynamic content will be inserted here -->

                </div>
              </div>

              <!-- Chatbox footer -->
              <div class="chatbox-footer custom-h-10 d-flex align-items-center" id="chatbox-footer">
                <div class="container-fluid d-flex align-items-center position-relative"
                  id="message-input">
                  <form class="chat-form w-100 h-100 d-flex align-items-center" id="chat-form">
                    <input type="hidden" id="sender" value="<?php echo $username; ?>">
                    <input type="hidden" id="receiver" value="<?php echo $selectedUser; ?>">
                    <div class="d-flex justify-content-center align-items-center h-100 pe-3">
                      <i class="fa-solid fa-paperclip fa-xl "></i>
                    </div>
                    <input type="text"
                      id="message"
                      class="form-control bg-accent pe-5"
                      placeholder="Type a message"
                      aria-label="Type a message">
                    <button type="submit" class="send-button btn bg-accent rounded-3 p-0 m-0 position-absolute">
                      <i class="fa-solid fa-paper-plane fa-xl"></i>
                    </button>
                  </form>
                </div>
              </div>
            <?php endif; ?>
          </div>
          <!-- Chatbox End -->
        </div>
      </div>
    </main>
    <!-- Chat Container End -->
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="chat.js"></script>
  <script src="https://kit.fontawesome.com/74954d4a6a.js"
    crossorigin="anonymous"></script>
</body>

</html>