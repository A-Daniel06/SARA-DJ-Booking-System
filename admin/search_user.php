<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>User Search</title>
<style>
<?php include 'style.php'; ?>
form {
  background:#fff;
  padding:20px;
  margin-bottom:20px;
  border-radius:8px;
  box-shadow:0 2px 6px rgba(0,0,0,0.1);
}
form input[type="text"] {
  padding:10px;
  width:250px;
  border:1px solid #ccc;
  border-radius:6px;
}
form button {
  padding:10px 20px;
  background:#2ecc71;
  color:#fff;
  border:none;
  border-radius:6px;
  cursor:pointer;
}
form button:hover { background:#27ae60; }
table {width:100%;border-collapse:collapse;background:#fff;}
th,td {padding:12px;border:1px solid #ddd;text-align:left;}
th {background:#16a085;color:#fff;}
tr:nth-child(even){background:#f9f9f9;}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="topbar"><h1>User Search</h1></div>
<div class="container">
  <form method="post" action="">
    <input type="text" name="keyword" placeholder="Enter username, email, or mobile">
    <button type="submit">Search</button>
  </form>

  <table>
    <tr><th>ID</th><th>Username</th><th>Email</th><th>Mobile</th></tr>
    <?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $kw=$_POST['keyword'];
      // Static Example Data
      if($kw=="ravi" || $kw=="ravi@example.com"){
        echo "<tr><td>1</td><td>Ravi</td><td>ravi@example.com</td><td>9876543210</td></tr>";
      }
      if($kw=="priya"){
        echo "<tr><td>2</td><td>Priya</td><td>priya@example.com</td><td>9123456780</td></tr>";
      }
    }
    ?>
  </table>
</div>
</body>
</html>
