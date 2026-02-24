<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Booking Search</title>
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
  background:#e67e22;
  color:#fff;
  border:none;
  border-radius:6px;
  cursor:pointer;
}
form button:hover { background:#d35400; }
table {width:100%;border-collapse:collapse;background:#fff;}
th,td {padding:12px;border:1px solid #ddd;text-align:left;}
th {background:#c0392b;color:#fff;}
tr:nth-child(even){background:#f9f9f9;}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="topbar"><h1>Booking Search</h1></div>
<div class="container">
  <form method="post" action="">
    <input type="text" name="keyword" placeholder="Enter Booking ID, Username, or Event">
    <button type="submit">Search</button>
  </form>

  <table>
    <tr><th>Booking ID</th><th>User</th><th>Service</th><th>Date</th><th>Status</th></tr>
    <?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
      $kw=$_POST['keyword'];
      // Static Example Data
      if($kw=="1" || $kw=="Ravi"){
        echo "<tr><td>1</td><td>Ravi</td><td>Wedding DJ</td><td>2025-09-15</td><td>Approved</td></tr>";
      }
      if($kw=="2" || $kw=="Priya"){
        echo "<tr><td>2</td><td>Priya</td><td>Birthday DJ</td><td>2025-09-20</td><td>Pending</td></tr>";
      }
    }
    ?>
  </table>
</div>
</body>
</html>
