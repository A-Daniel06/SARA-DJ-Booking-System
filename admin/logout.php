<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logged Out - SARA DJ Booking</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #2c3e50;
      color: #fff;
      text-align: center;
      padding-top: 100px;
    }
    .message-box {
      background: rgba(0,0,0,0.7);
      padding: 30px;
      border-radius: 10px;
      display: inline-block;
    }
    a {
      color: #f39c12;
      text-decoration: none;
      font-weight: bold;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="message-box">
    <h2>You have successfully logged out!</h2>
    <p><a href="admin_login.php">Click here</a> to login again.</p>
    <p><a href="index.php">Go to Home</a></p>
  </div>
</body>
</html>
