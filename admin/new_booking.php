<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>New Bookings</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
<style>
body {
  margin:0;
  font-family:'Segoe UI', Arial, sans-serif;
  background: linear-gradient(135deg, #36d1c4 0%, #5b86e5 50%, #7f53ac 100%);
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
  background: linear-gradient(120deg, #5b86e5 0%, #36d1c4 100%);
  color: #fff;
  background-blend-mode: overlay;
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
  background: linear-gradient(90deg, #7f53ac, #5b86e5);
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
  border-bottom: 3px solid #5b86e5;
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
button {
  padding:12px 22px;
  border:none;
  border-radius:8px;
  cursor:pointer;
  font-size:1.1rem;
  font-weight:700;
  margin-right:8px;
  transition:background 0.18s, color 0.18s, transform 0.15s;
  display:inline-flex;
  align-items:center;
  gap:7px;
}
.approve {
  background:linear-gradient(90deg,#36d1c4,#5b86e5);
  color:#fff;
}
.approve:hover {
  background:linear-gradient(90deg,#5b86e5,#36d1c4);
  color:#fff;
  transform:scale(1.07);
}
.reject {
  background:linear-gradient(90deg,#7f53ac,#5b86e5);
  color:#fff;
}
.reject:hover {
  background:linear-gradient(90deg,#5b86e5,#7f53ac);
  color:#fff;
  transform:scale(1.07);
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
<div class="topbar"><h1 style="margin:0; font-size:2.2rem; color:#ff4e50; letter-spacing:1.5px;">New Bookings</h1></div>
<div class="main-content">
  <div class="booking-card">
    <h2><i class="fa fa-calendar-check"></i> New Bookings</h2>
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
          <th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM tblbooking WHERE EventType = 'Pending' ORDER BY ID DESC";
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
            echo '<td class="d-none d-sm-table-cell"><span class="badge badge-warning">Pending</span></td>';
            echo '<td class="d-none d-sm-table-cell">';
            echo '<a href="view_booking.php?id=' . $row->ID . '" class="btn btn-info btn-sm" style="background:#19c6df;border:none;color:#fff;padding:8px 24px;font-weight:600;border-radius:6px;">View</a>';
            echo '</td>';
            echo '</tr>';
            $cnt++;
          }
        } else {
          echo '<tr><td colspan="8">No new bookings found.</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
