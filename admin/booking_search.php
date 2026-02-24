<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Booking Search</title>
<style>
body {
  margin: 0;
  font-family: 'Segoe UI', Arial, sans-serif;
  background: #f7f8fa;
  min-height: 100vh;
}
.topbar {
  background: #2563eb;
  color: #fff;
  padding: 32px 0 24px 0;
  text-align: center;
  font-size: 2.8rem;
  font-weight: bold;
  letter-spacing: 2px;
  box-shadow: 0 4px 24px rgba(0,0,0,0.10);
  margin-bottom: 32px;
}
.container {
  max-width: 950px;
  margin: 40px auto 0 auto;
  background: #fff7f0;
  border-radius: 24px;
  box-shadow: 0 8px 40px rgba(230,126,34,0.10);
  padding: 48px 40px 40px 40px;
  min-height: 400px;
  display: flex;
  flex-direction: column;
  align-items: center;
}
form {
  background: #f7f8fa;
  padding: 32px 32px 24px 32px;
  margin-bottom: 32px;
  border-radius: 14px;
  box-shadow: 0 2px 16px rgba(230,126,34,0.08);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 18px;
  font-size: 1.25rem;
}
form input[type="text"] {
  padding: 16px 18px;
  width: 320px;
  border: 1.5px solid #e67e22;
  border-radius: 8px;
  font-size: 1.15rem;
  background: #fff;
  color: #e67e22;
  font-weight: 500;
}
form button {
  padding: 14px 36px;
  background: #e67e22;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1.15rem;
  font-weight: 700;
  box-shadow: 0 2px 8px rgba(230,126,34,0.10);
  transition: background 0.2s, transform 0.2s;
}
form button:hover {
  background: #c0392b;
  color: #fff;
  transform: translateY(-2px) scale(1.04);
}
table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  background: #fff;
  color: #e67e22;
  font-size: 1.25rem;
  border-radius: 18px;
  overflow: hidden;
  box-shadow: 0 2px 16px rgba(230,126,34,0.08);
  margin-bottom: 0;
}
th, td {
  padding: 20px 18px;
  border-bottom: 1px solid #f6e9dd;
  text-align: left;
}
th {
  background: #e67e22;
  color: #fff;
  font-size: 1.3rem;
  letter-spacing: 1px;
  border: none;
}
tr:nth-child(even) td {
  background: #fff1e0;
}
tr:last-child td {
  border-bottom: none;
}
td {
  font-size: 1.15rem;
  color: #e67e22;
}
@media (max-width: 900px) {
  .container { padding: 24px 6vw; }
  th, td { padding: 12px 8px; font-size: 1rem; }
  .topbar { font-size: 2rem; }
  form { padding: 18px 4vw; font-size: 1rem; }
  form input[type="text"] { width: 100%; }
}
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
