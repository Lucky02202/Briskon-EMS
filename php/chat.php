<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      width: 100vw;
    }

    .main {
      height: 500px;
      width: 500px;
      border-radius: 50px;
      background-color: rgb(118, 255, 228);
      display: flex;
      align-items: center;
      justify-content: center;
      color: black;
      font-size: 2rem;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 2rem;
      flex-direction: column;
    }

    .btn {
      padding: 8px;
      border-radius: 1rem;
      background-color: orange;
      font-size: 1rem !important;
      cursor: pointer;
    }
  </style>
</head>

<body>
  <div class="main">
    This is Chat Module
    <div class="btn" onclick="destroySession()"> Logout</div>
  </div>

  <Script>
    function destroySession() {
      window.location.href = " ./logout.php"
    }
  </Script>
</body>

</html>