<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Contact Us</title>
<style>
<?php include 'style.php'; ?>
form {
  background:#fff;
  padding:20px;
  border-radius:8px;
  box-shadow:0 2px 6px rgba(0,0,0,0.1);
}
form textarea {
  width:100%;
  height:200px;
  padding:12px;
  border:1px solid #ccc;
  border-radius:6px;
  font-size:16px;
  resize:none;
}
form button {
  margin-top:15px;
  padding:10px 20px;
  background:#27ae60;
  color:#fff;
  border:none;
  border-radius:6px;
  cursor:pointer;
}
form button:hover { background:#1e8449; }
.message {
  background:#2ecc71;
  color:#fff;
  padding:10px;
  margin-bottom:15px;
  border-radius:6px;
}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="topbar"><h1>Edit Contact Us Page</h1></div>
<div class="container">
  <?php
  if($_SERVER['REQUEST_METHOD']=="POST"){
    $content=$_POST['content'];
    echo "<div class='message'>Contact Us Page Updated Successfully!</div>";
  }
  ?>
  <form method="post" action="">
    <label>Edit Contact Information:</label><br><br>
    <textarea name="content">SARA DJ Services
Phone: +91 9876543210
Email: info@saradjs.com
Address: Mumbai, Maharashtra, India</textarea>
    <button type="submit">Save</button>
  </form>
</div>
</body>
</html>
