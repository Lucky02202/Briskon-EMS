<?php

session_start();
include 'db.php';

if (isset($_SESSION['username'])) {
  header("Location: ../test/Chat/chat.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  // $profileImg = file_get_contents($_FILES['profileImg']['tmp_name']);


  // Check if username already exists
  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $error = "Username already exists";
  } else {
    // Insert user into database
    $stmt = $conn->prepare(("INSERT INTO users (username, password) VALUES (?,?)"));
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param('ss', $username, $password);

    if ($stmt->execute()) {
      $_SESSION['username'] = $username;
      header("Location: ../test/Chat/chat.php");
    } else {
      $error = "Registration Failed";
    }
  }
  $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet"
    href="../main.css">
  <link rel="stylesheet"
    href="./styles/register.css">
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
  <div class="container-fluid m-0 p-2 bg-background vh-100 d-flex align-items-center justify-content-center">
    <main class="custom-30 custom-h-80 bg-main rounded-5 p-2">
      <div class="custom-h-10 w-100 d-flex align-items-center justify-content-center">
        <img src="../Assets/briskon-logo-1-1.png" class="h-100" alt="logo">
      </div>
      <div class="custom-h-90 w-100 bg-black rounded-5 p-2">
        <div class="p-3 custom-h-40 rounded-5  d-flex flex-column gap-2 justify-content-center">
          <h5 class="fw-bold text-login-secondary">Start for Free</h5>
          <h3 class="text-white">Create <br>your account</h3>
        </div>
        <div class="p-2 custom-h-50 rounded-5 ">
          <?php
          if (isset($error)) : ?>
            <p class="error custom-h-10 text-danger text-center">
              <?php echo htmlspecialchars($error); ?>
            </p>
          <?php endif; ?>
          <form method="post" class="d-flex flex-column align-items-center w-100 h-100" enctype="multipart/form-data">
            <input class="login-input form-control bg-login-background rounded-5 custom-80" placeholder="Username" type="text" id="username" name="username" required><br>
            <input class="login-input form-control bg-login-background rounded-5 custom-80" placeholder="Password" type="password" id="password" name="password" required><br>
            <!-- <div class="file-container text-white custom-80 rounded-4 d-flex flex-column gap-1 justify-content-start p-2">
              <p class="m-0 p-0 fw-light opacity-50">Upload Profile Picture</p>
              <input class="file-upload bg-accent m-0 p-0" type="file" name="profileImg" accept="image/*" required>
            </div> -->
            <button type="submit" class="login-button btn-outline-danger p-2 pe-3 ps-3 rounded-5 text-white fw-semibold">Register</button>
          </form>
        </div>
        <div class="custom-h-10 w-100 d-flex align-items-center justify-content-center">
          <a href="login.php" class="text-login-secondary text-decoration-none text-size fs-5"><span class="text-white">Already have an account?</span> <span class="text-orange">Login</span></a>
        </div>
      </div>
    </main>
  </div>
</body>

</html>