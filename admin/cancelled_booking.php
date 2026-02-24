<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Cancelled Bookings</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<style>
body {
  margin:0;
  font-family:'Segoe UI', Arial, sans-serif;
  background: linear-gradient(135deg, #ff5858 0%, #f09819 100%);
  min-height:100vh;
  color: #fff;
}
.main-content {
  margin-left:270px;
  padding:60px 0 0 0;
  min-height:100vh;
  display:flex;
  flex-direction:column;
  align-items:center;
  justify-content:flex-start;
}
.booking-card {
  background: linear-gradient(120deg, #f85032 0%, #e73827 100%);
  color: #fff;
  border-radius:28px;
  box-shadow:0 12px 40px rgba(44,62,80,0.18);
  padding:48px 44px 38px 44px;
  max-width:1100px;
  width:95vw;
  margin:40px auto 0 auto;
  animation:fadeIn 0.7s;
  position:relative;
  overflow-x:auto;
}
@keyframes fadeIn {
  from { opacity:0; transform:translateY(30px); }
  to { opacity:1; transform:translateY(0); }
}
.topbar {
  background: linear-gradient(90deg, #e73827, #f85032);
  color: #fff;
  padding: 32px;
  text-align: center;
  font-size: 2.2rem;
  font-weight: bold;
  letter-spacing: 2px;
  box-shadow: 0 4px 18px rgba(0,0,0,0.13);
}
.booking-card h2 {
  font-size:2rem;
  color:#fff;
  margin-bottom:32px;
  font-weight:900;
  letter-spacing:1.5px;
  text-align:center;
}
table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  background: #111;
  font-size: 1rem;
  margin-top: 0;
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 2px 16px rgba(0,0,0,0.18);
}
th, td {
  padding: 12px 10px;
  border-bottom: 2px solid #333;
  text-align: center;
  font-size: 0.98rem;
  color: #fff;
  vertical-align: middle;
}
th {
  background: #222;
  color: #fff;
  font-size: 1.08rem;
  font-weight: 700;
  letter-spacing: 0.5px;
  border-bottom: 3px solid #e73827;
}
tr:last-child td {
  border-bottom:none;
}
tr {
  transition:background 0.18s;
}
tr:hover td {
  background:rgba(255,255,255,0.08);
}
@media (max-width: 1100px) {
  .booking-card {
    max-width:99vw;
    padding:18px 4vw 18px 4vw;
  }
  table, th, td {
    font-size:1rem;
    padding:12px 6px;
  }
}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<?php include_once '../includes/dbconnection.php'; ?>
<div class="topbar"><h1 style="margin:0; font-size:2.2rem; color:#fff; letter-spacing:1.5px;">Cancelled Bookings</h1></div>
<div class="main-content">
  <div class="booking-card">
    <h2><i class="fa fa-calendar-times"></i> Cancelled Bookings</h2>
    <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
      <thead>
        <tr>
          <th class="text-center"></th>
          <th>Booking ID</th>
          <th class="d-none d-sm-table-cell">Customer Name</th>
          <th class="d-none d-sm-table-cell">Mobile Number</th>
          <th class="d-none d-sm-table-cell">Email</th>
          <th class="d-none d-sm-table-cell">Booking Date</th>
          <th class="d-none d-sm-table-cell">Status</th>
        
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM tblbooking WHERE EventType = 'Cancelled' ORDER BY ID DESC";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
          foreach ($results as $row) {
            echo '<tr>';
            echo '<td class="text-center">' . $cnt . '</td>';
            echo '<td>' . htmlspecialchars($row->BookingID) . '</td>';
            echo '<td class="d-none d-sm-table-cell">' . htmlspecialchars($row->Name) . '</td>';
            echo '<td class="d-none d-sm-table-cell">' . htmlspecialchars($row->MobileNumber) . '</td>';
            echo '<td class="d-none d-sm-table-cell">' . htmlspecialchars($row->Email) . '</td>';
            echo '<td class="d-none d-sm-table-cell">' . htmlspecialchars($row->BookingDate) . '</td>';
            echo '<td class="d-none d-sm-table-cell"><span class="badge badge-danger">Cancelled</span></td>';
            // Action column removed for cancelled bookings; status shown instead
            echo '</tr>';
            $cnt++;
          }
        } else {
          echo '<tr><td colspan="7">No cancelled bookings found.</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
