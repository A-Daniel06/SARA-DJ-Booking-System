<?php
session_start();
// Use the project's DB connection. db.php was missing, so include the PDO connection
include_once __DIR__ . '/../includes/dbconnection.php';

// Create a mysqli connection for legacy code that expects $conn (mysqli)
$conn = mysqli_connect('localhost', 'root', '', 'sara_dj');
if (!$conn) {
    die('MySQL connection failed: ' . mysqli_connect_error());
}

// Get booking ID from query string (support both editid and id)
$booking_id = isset($_GET['editid']) ? intval($_GET['editid']) : (isset($_GET['id']) ? intval($_GET['id']) : 0);

if ($booking_id <= 0) {
    echo "<h3 style='color:red; text-align:center;'>Invalid Booking ID</h3>";
    exit();
}

// Handle status update (Approved / Cancelled)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $newStatus = $_POST['status'] ?? '';
    $remark = isset($_POST['remark']) ? trim($_POST['remark']) : '';
    if (in_array($newStatus, ['Approved', 'Cancelled', 'Pending'])) {
        $up = $conn->prepare("UPDATE tblbooking SET EventType = ? WHERE ID = ?");
        $up->bind_param('si', $newStatus, $booking_id);
        $up->execute();
        
        // If AdminRemark column exists, update it as well
        $colCheck = mysqli_query($conn, "SHOW COLUMNS FROM tblbooking LIKE 'AdminRemark'");
        if ($colCheck && mysqli_num_rows($colCheck) > 0 && $remark !== '') {
            $up2 = $conn->prepare("UPDATE tblbooking SET AdminRemark = ? WHERE ID = ?");
            $up2->bind_param('si', $remark, $booking_id);
            $up2->execute();
            $up2->close();
        }
    }
    echo "<script>window.location.href = 'view_booking.php?editid={$booking_id}';</script>";
    exit();
}

// Fetch booking details from tblbooking
$stmt = $conn->prepare("SELECT * FROM tblbooking WHERE ID = ? LIMIT 1");
$stmt->bind_param('i', $booking_id);
$stmt->execute();
$res = $stmt->get_result();
$booking = $res->fetch_assoc();

// If booking not found, show message
if (!$booking) {
    echo "<h3 style='color:red; text-align:center;'>No booking found for ID {$booking_id}</h3>";
    exit();
}

// Try to fetch service details from services table (if the table exists)
$service_info = null;
if (!empty($booking['ServiceID'])) {
    $svc = $booking['ServiceID'];
    $tblCheck = mysqli_query($conn, "SHOW TABLES LIKE 'services'");
    if ($tblCheck && mysqli_num_rows($tblCheck) > 0) {
        // ServiceID may contain numeric id or service_name; try numeric id first
        if (ctype_digit((string)$svc)) {
            $s_stmt = $conn->prepare("SELECT * FROM services WHERE id = ? LIMIT 1");
            if ($s_stmt) {
                $s_stmt->bind_param('i', $svc);
                $s_stmt->execute();
                $r = $s_stmt->get_result();
                $service_info = $r->fetch_assoc();
                $s_stmt->close();
            }
        }

        // If not found by id, try by service_name
        if (!$service_info) {
            $s_stmt2 = $conn->prepare("SELECT * FROM services WHERE service_name = ? LIMIT 1");
            if ($s_stmt2) {
                $s_stmt2->bind_param('s', $svc);
                $s_stmt2->execute();
                $r2 = $s_stmt2->get_result();
                $service_info = $r2->fetch_assoc();
                $s_stmt2->close();
            }
        }
    } else {
        // services table missing — ignore and continue
        $service_info = null;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>View Booking - SARA DJ</title>
<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #f5f6fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1100px;
    margin: 50px auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 30px;
}

h2 {
    margin: 0 0 20px 0;
    font-size: 24px;
    color: #2c3e50;
    border-bottom: 3px solid #27ae60;
    display: inline-block;
    padding-bottom: 5px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    text-align: left;
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
}

th {
    width: 25%;
    background: #ecf0f1;
    color: #2c3e50;
    font-weight: 600;
}

td {
    color: #34495e;
}

.status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 5px;
    color: #fff;
    font-weight: bold;
}

.status.Approved {
    background: #27ae60;
}

.status.Pending {
    background: #f1c40f;
}

.status.Cancelled {
    background: #e74c3c;
}

.back-btn {
    display: inline-block;
    margin-top: 20px;
    background: #3498db;
    color: #fff;
    text-decoration: none;
    padding: 10px 18px;
    border-radius: 5px;
    transition: 0.3s;
}

.back-btn:hover {
    background: #2980b9;
}
/* Action form and buttons styling */
.form-box {
    margin-top: 24px;
    padding: 18px;
    border-radius: 10px;
    background: linear-gradient(180deg, #ffffff 0%, #f6fbff 100%);
    border: 1px solid #e6f0ff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}
.form-box h3 { margin-top:0; color:#2c3e50; }
.form-box label { font-weight:600; color:#34495e; }
.form-box textarea { width:100%; min-height:110px; resize:vertical; padding:10px 12px; border-radius:8px; border:1px solid #ccdbe9; font-size:15px; color:#34495e; }
.form-box select { padding:10px 12px; border-radius:8px; border:1px solid #ccdbe9; font-size:15px; color:#34495e; }
.btn { display:inline-block; padding:10px 18px; background:#27ae60; color:#fff; text-decoration:none; border:none; border-radius:8px; cursor:pointer; font-weight:700; }
.btn.secondary, .btn.btn-secondary { background:#95a5a6; color:#fff; }
.btn:hover { transform: translateY(-2px); box-shadow:0 6px 18px rgba(39,174,96,0.12); }
.btn.secondary:hover { transform:none; box-shadow:none; }

/* Small tweaks for table readability */
th, td { vertical-align: top; }
@media (max-width: 700px) {
    .form-box textarea { min-height:90px; }
    .btn { width:100%; display:block; margin-bottom:10px; }
}
</style>
</head>
<body>

<div class="container">
    <h2>View Booking</h2>

    <?php if ($booking) { ?>
    <table>
        <tr>
            <th>Booking Number</th>
            <td><?php echo htmlspecialchars($booking['BookingID']); ?></td>
            <th>Client Name</th>
            <td><?php echo htmlspecialchars($booking['Name']); ?></td>
        </tr>
        <tr>
            <th>Mobile Number</th>
            <td><?php echo htmlspecialchars($booking['MobileNumber']); ?></td>
            <th>Email</th>
            <td><?php echo htmlspecialchars($booking['Email']); ?></td>
        </tr>
        <tr>
            <th>Event Date</th>
            <td><?php echo htmlspecialchars($booking['EventDate']); ?></td>
            <th>Event Starting Time</th>
            <td><?php echo htmlspecialchars($booking['EventStartingtime']); ?></td>
        </tr>
        <tr>
            <th>Event Ending Time</th>
            <td><?php echo htmlspecialchars($booking['EventEndingtime']); ?></td>
            <th>Venue Address</th>
            <td><?php echo htmlspecialchars($booking['VenueAddress']); ?></td>
        </tr>
        <tr>
            <th>Event Type</th>
            <td><?php echo htmlspecialchars($booking['EventType']); ?></td>
            <th>Service Name</th>
            <td><?php echo htmlspecialchars($service_info['service_name'] ?? $booking['ServiceID']); ?></td>
        </tr>
        <tr>
            <th>Apply Date</th>
            <td><?php echo htmlspecialchars($booking['BookingDate']); ?></td>
            <th>Order Final Status</th>
            <td>
                <?php
                $st = $booking['Status'] ?? '';
                if ($st == '' || strtolower($st) == 'pending') {
                    echo '<span class="status Pending">Not Processed Yet</span>';
                } elseif (strtolower($st) == 'approved') {
                    echo '<span class="status Approved">Approved Stage</span>';
                } elseif (strtolower($st) == 'cancelled') {
                    echo '<span class="status Cancelled">Cancelled</span>';
                } else {
                    echo htmlspecialchars($st);
                }
                ?>
            </td>
        </tr>
        <tr>
            <th>Admin Remark</th>
            <td colspan="3"><?php echo !empty($booking['AdminRemark']) ? htmlspecialchars($booking['AdminRemark']) : 'Not Updated Yet'; ?></td>
        </tr>
    </table>

    <?php if (empty($booking['EventType']) || $booking['EventType'] == 'Pending') { ?>
    <div class="form-box">
        <h3>Take Action</h3>
        <form method="post">
            <label>Remark:</label><br>
            <textarea name="remark" rows="4" placeholder="Enter your remark..."></textarea><br><br>

            <label>Status:</label><br>
            <select name="status" required>
                <option value="">Select</option>
                <option value="Approved">Approved</option>
                <option value="Cancelled">Cancelled</option>
            </select><br><br>

            <button type="submit" name="update_status" class="btn">Update</button>
            <a href="all_booking.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
    <?php } ?>

    <?php } else { ?>
        <p style="color:red;">No booking details found!</p>
    <?php } ?>
    <?php if (!empty($booking['EventType']) && $booking['EventType'] !== 'Pending') { ?>
        <form method="post" style="margin-top:20px;">
            <input type="hidden" name="remark" value="">
            <input type="hidden" name="status" value="Pending">
            <button type="submit" name="update_status" class="btn" style="background:#f1c40f;color:#fff;padding:10px 18px;border:none;border-radius:5px;cursor:pointer;">
                Take Actions
            </button>
        </form>
    <?php } ?>

    <!-- <a href="manage_booking.php" class="back-btn">← Back to Bookings</a> -->
</div>

</body>
</html>
