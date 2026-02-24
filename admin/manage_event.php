<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Events - SARA DJ</title>
<!-- Include jQuery + DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<style>
<?php include 'style.php'; ?>

body {
  font-family: 'Segoe UI', Arial, sans-serif;
  background: #f4f6f9;
  margin: 0;
}

/* Topbar */
.topbar {
  background: linear-gradient(90deg, #2c3e50, #34495e);
  color: #fff;
  padding: 20px;
  text-align: center;
  font-size: 24px;
  font-weight: bold;
  letter-spacing: 1px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Container */
.container {
  max-width: 1100px;
  margin: 30px auto;
  background: #fff;
  padding: 25px;
  border-radius: 10px;
  box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

/* Table */
table.dataTable {
  width: 100%;
  border-collapse: collapse !important;
}

table.dataTable th {
  background: #e67e22;
  color: #fff;
  padding: 12px;
  text-align: left;
}

table.dataTable td {
  padding: 12px;
  font-size: 15px;
}

/* Buttons */
.action-btn {
  padding: 6px 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
}

.delete {
  background: #e74c3c;
  color: #fff;
}

.delete:hover {
  background: #c0392b;
}

.edit {
  background: #27ae60;
  color: #fff;
}

.edit:hover {
  background: #1e8449;
}

/* Pagination and Search */
.dataTables_wrapper .dataTables_paginate .paginate_button {
  padding: 5px 10px;
  margin: 2px;
  border-radius: 5px;
  border: 1px solid #ddd;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  background: #3498db;
  color: #fff !important;
  border: none;
}

.dataTables_wrapper .dataTables_filter input {
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 6px;
}

</style>
</head>
<body>
<?php include 'sidebar.php'; ?>

<div class="topbar"><h1>Manage Event Type</h1></div>

<div class="container">
  <h2>Manage Event Type</h2>
  <table id="eventsTable" class="display">
    <thead>
      <tr>
        <th>ID</th>
        <th>Event Name</th>
        <th>Creation Date</th>
        <th>Creation Date</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td><b>Anniversary</b></td>
        <td>2024-09-10 12:31:39</td>
        <td><span style="background:#3498db;color:#fff;padding:6px 12px;border-radius:6px;">2024-09-10 12:31:39</span></td>
        <td><button class="action-btn delete">Delete</button></td>
      </tr>
      <tr>
        <td>2</td>
        <td><b>Birthday Party</b></td>
        <td>2024-09-10 12:31:39</td>
        <td><span style="background:#3498db;color:#fff;padding:6px 12px;border-radius:6px;">2024-09-10 12:31:39</span></td>
        <td><button class="action-btn delete">Delete</button></td>
      </tr>
      <tr>
        <td>3</td>
        <td><b>Concert</b></td>
        <td>2024-09-10 12:31:39</td>
        <td><span style="background:#3498db;color:#fff;padding:6px 12px;border-radius:6px;">2024-09-10 12:31:39</span></td>
        <td><button class="action-btn delete">Delete</button></td>
      </tr>
    </tbody>
  </table>
</div>

<script>
$(document).ready(function(){
    $('#eventsTable').DataTable({
        "pageLength": 8
    });
});
</script>

</body>
</html>
