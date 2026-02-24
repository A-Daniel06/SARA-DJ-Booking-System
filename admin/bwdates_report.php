<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>B/W Dates Report</title>
<style>
body {
  margin: 0;
  font-family: 'Segoe UI', Arial, sans-serif;
  background: #eaf3fb;
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
  max-width: 1100px;
  margin: 40px auto 0 auto;
  background: #f4faff;
  border-radius: 24px;
  box-shadow: 0 8px 40px rgba(37,99,235,0.10);
  padding: 48px 40px 40px 40px;
  min-height: 400px;
  display: flex;
  flex-direction: column;
  align-items: center;
}
form {
  background: #eaf3fb;
  padding: 32px 32px 24px 32px;
  margin-bottom: 32px;
  border-radius: 14px;
  box-shadow: 0 2px 16px rgba(37,99,235,0.08);
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 18px;
  font-size: 1.25rem;
}
form label {
  font-weight: 600;
  color: #2563eb;
  margin-right: 6px;
  font-size: 1.15rem;
}
form input[type="date"] {
  padding: 12px 16px;
  margin-right: 10px;
  border: 1.5px solid #2563eb;
  border-radius: 8px;
  font-size: 1.1rem;
  background: #fff;
  color: #2563eb;
  font-weight: 500;
}
form button {
  padding: 12px 32px;
  background: #2563eb;
  border: none;
  color: #fff;
  border-radius: 8px;
  cursor: pointer;
  font-size: 1.15rem;
  font-weight: 700;
  box-shadow: 0 2px 8px rgba(37,99,235,0.10);
  transition: background 0.2s, transform 0.2s;
}
form button:hover {
  background: #174ea6;
  color: #fff;
  transform: translateY(-2px) scale(1.04);
}
table {
  width: 100%;
  border-collapse: separate;
  border-spacing: 0;
  background: #fff;
  color: #2563eb;
  font-size: 1.25rem;
  border-radius: 18px;
  overflow: hidden;
  box-shadow: 0 2px 16px rgba(37,99,235,0.08);
  margin-bottom: 0;
}
th, td {
  padding: 20px 18px;
  border-bottom: 1px solid #dbeafe;
  text-align: left;
}
th {
  background: #2563eb;
  color: #fff;
  font-size: 1.3rem;
  letter-spacing: 1px;
  border: none;
}
tr:nth-child(even) td {
  background: #eaf3fb;
}
tr:last-child td {
  border-bottom: none;
}
td {
  font-size: 1.15rem;
  color: #2563eb;
}
.status-approved {
  background: #2563eb;
  color: #fff;
  padding: 7px 18px;
  border-radius: 16px;
  font-weight: bold;
  font-size: 1.05rem;
  display: inline-block;
  letter-spacing: 1px;
  box-shadow: 0 1px 6px rgba(37,99,235,0.10);
}
.status-pending {
  background: #dbeafe;
  color: #174ea6;
  padding: 7px 18px;
  border-radius: 16px;
  font-weight: bold;
  font-size: 1.05rem;
  display: inline-block;
  letter-spacing: 1px;
  box-shadow: 0 1px 6px rgba(219,234,254,0.10);
}
@media (max-width: 900px) {
  .container { padding: 24px 6vw; }
  th, td { padding: 12px 8px; font-size: 1rem; }
  .topbar { font-size: 2rem; }
  form { padding: 18px 4vw; font-size: 1rem; }
}
</style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<?php include_once __DIR__ . '/../includes/dbconnection.php'; ?>
<div class="topbar">B/W Dates Booking Report</div>
<div class="container">
  <form method="post" action="">
    <label>From: </label>
    <input type="date" name="from_date" required>
    <label>To: </label>
    <input type="date" name="to_date" required>
    <button type="submit"><i class="fa fa-search"></i> Get Report</button>
  </form>

  <table>
    <tr>
      <th>ID</th>
      <th>Customer</th>
      <th>Service</th>
      <th>Event Date</th>
      <th>Status</th>
    </tr>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $from = $_POST['from_date'] ?? '';
      $to = $_POST['to_date'] ?? '';
      // validate dates
      try {
        $fromDt = new DateTime($from);
        $toDt = new DateTime($to);
        // format as YYYY-MM-DD (compare dates to include any datetime values)
        $fromStr = $fromDt->format('Y-m-d');
        $toStr = $toDt->format('Y-m-d');

  // Use DATE(EventDate) so rows with datetime values are properly included
  $sql = "SELECT ID, BookingID, Name, MobileNumber, Email, ServiceID, EventDate, EventType, BookingDate FROM tblbooking 
    WHERE DATE(EventDate) BETWEEN :from AND :to ORDER BY ID ASC";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':from', $fromStr);
        $stmt->bindParam(':to', $toStr);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
        if ($rows && count($rows) > 0) {
          foreach ($rows as $r) {
            $status = strtolower($r->EventType ?? 'pending');
            $badge = "<span class='status-pending'>Pending</span>";
            if ($status === 'approved') $badge = "<span class='status-approved'>Approved</span>";
            if ($status === 'cancelled') $badge = "<span class='status-pending' style='background:#fdecea;color:#c62828;'>Cancelled</span>";
            echo '<tr>';
            echo '<td>' . htmlspecialchars($r->ID) . '</td>';
            echo '<td>' . htmlspecialchars($r->Name) . '</td>';
            echo '<td>' . htmlspecialchars($r->ServiceID) . '</td>';
            echo '<td>' . htmlspecialchars($r->EventDate) . '</td>';
            echo '<td>' . $badge . '</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="5" style="text-align:center;">No bookings found in selected date range.</td></tr>';
        }
      } catch (Exception $e) {
        echo '<tr><td colspan="5" style="text-align:center;color:red;">Invalid date range.</td></tr>';
      }
    }
    ?>
  </table>
</div>
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
