<?php

session_start();
include('./db.php');

if (isset($_SESSION['username'])) {
  header("Location: chat.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users where username='$username' AND password='$password'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
    $_SESSION['username'] = $username;
    header("Location: chat.php");
    exit();
  } else {
    $error = "Invalid Username or Password.";
  }
}
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
    href="./styles/login.css">
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

          <h3 class="text-white">Login to <br>your account</h3>
        </div>
        <div class="p-2 custom-h-50 rounded-5 ">
          <?php
          if (isset($error)) : ?>
            <p class="error text-danger text-center w-100">
              <?php echo htmlspecialchars($error); ?>
            </p>
          <?php endif; ?>
          <form method="post" class="d-flex flex-column  align-items-center w-100 h-100">
            <input class="login-input form-control bg-login-background rounded-5 custom-80" placeholder="Username" type="text" id="username" name="username" required><br>
            <input class="login-input form-control bg-login-background rounded-5 custom-80" placeholder="Password" type="password" id="password" name="password" required><br>
            <button type="submit" class="login-button btn-outline-danger p-2 pe-3 ps-3 rounded-5 text-white fw-semibold">Login</button>
          </form>
        </div>
        <div class="custom-h-10 w-100 d-flex align-items-center justify-content-center">
          <a href="register.php" class="text-login-secondary text-decoration-none text-size fs-5"><span class="text-white">Don't have an account?</span> <span class="text-orange">Signup</span></a>
        </div>
      </div>
    </main>
  </div>
</body>

</html>