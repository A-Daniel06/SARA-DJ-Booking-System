<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Events</title>
<style>
<?php include 'style.php'; ?>
table {width:100%;border-collapse:collapse;background:#fff;}
th,td {padding:12px;border:1px solid #ddd;text-align:left;}
th {background:#e67e22;color:#fff;}
tr:nth-child(even){background:#f9f9f9;}
.action-btn {padding:5px 10px;border:none;border-radius:4px;cursor:pointer;}
.edit {background:#27ae60;color:#fff;}
.delete {background:#e74c3c;color:#fff;}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="topbar"><h1>Manage Events</h1></div>
<div class="container">
  <table>
    <tr><th>ID</th><th>Event Name</th><th>Actions</th></tr>
    <tr><td>1</td><td>Wedding</td><td><button class="action-btn edit">Edit</button> <button class="action-btn delete">Delete</button></td></tr>
    <tr><td>2</td><td>Birthday</td><td><button class="action-btn edit">Edit</button> <button class="action-btn delete">Delete</button></td></tr>
  </table>
</div>
</body>
</html>
