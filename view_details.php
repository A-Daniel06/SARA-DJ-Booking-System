<?php
// Public booking details view used by Request Status results
include_once __DIR__ . '/db.php';

$booking_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($booking_id <= 0) {
    echo '<p style="color:red;text-align:center;margin-top:40px;">Invalid booking id.</p>';
    exit();
}

// Try to fetch from tblbooking first
$sql = "SELECT * FROM tblbooking WHERE ID = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $booking_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$booking = $res && mysqli_num_rows($res) ? mysqli_fetch_assoc($res) : null;
mysqli_stmt_close($stmt);

// Fallback to legacy bookings
if (!$booking) {
    $sql2 = "SELECT * FROM bookings WHERE id = ? LIMIT 1";
    $s2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($s2, 'i', $booking_id);
    mysqli_stmt_execute($s2);
    $r2 = mysqli_stmt_get_result($s2);
    $booking = $r2 && mysqli_num_rows($r2) ? mysqli_fetch_assoc($r2) : null;
    mysqli_stmt_close($s2);
}

if (!$booking) {
    echo '<p style="color:red;text-align:center;margin-top:40px;">No booking found.</p>';
    exit();
}

// Normalize field access
$get = function($k) use ($booking) {
    return isset($booking[$k]) ? $booking[$k] : '';
};

?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>View Booking Details</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background:#f7f8fb; margin:0; padding:30px; }
        .box { max-width:1100px; margin:20px auto; background:#fff; border-radius:8px; padding:24px; box-shadow:0 6px 24px rgba(0,0,0,0.08); }
        h1 { margin:0 0 18px 0; color:#16324f; font-size:24px; border-bottom:3px solid #27ae60; display:inline-block; padding-bottom:6px }
        table { width:100%; border-collapse:collapse; margin-top:18px; }
        th, td { padding:16px 18px; border-bottom:1px solid #eee; }
        th { width:28%; background:#ecf0f1; color:#2c3e50; text-align:left; }
        td { color:#34495e; }
        .status { display:inline-block; padding:8px 14px; border-radius:6px; font-weight:700; }
        .status.pending { background:#f1c40f; color:#fff }
        .status.approved { background:#27ae60; color:#fff }
        .status.cancelled { background:#e74c3c; color:#fff }
        .back { display:inline-block; margin-top:18px; padding:10px 16px; background:#3498db; color:#fff; text-decoration:none; border-radius:6px }
    </style>
</head>
<body>
<div class="box">
    <h1>View Booking</h1>
    <table>
        <tr><th>Booking Number</th><td><?php echo htmlspecialchars($get('BookingID') ?: $get('id')); ?></td>
            <th>Client Name</th><td><?php echo htmlspecialchars($get('Name') ?: $get('username')); ?></td></tr>
        <tr><th>Mobile Number</th><td><?php echo htmlspecialchars($get('MobileNumber') ?: $get('mobile')); ?></td>
            <th>Email</th><td><?php echo htmlspecialchars($get('Email') ?: $get('email')); ?></td></tr>
        <tr><th>Event Date</th><td><?php echo htmlspecialchars($get('EventDate') ?: ''); ?></td>
            <th>Event Starting Time</th><td><?php echo htmlspecialchars($get('EventStartingtime') ?: ''); ?></td></tr>
        <tr><th>Event Ending Time</th><td><?php echo htmlspecialchars($get('EventEndingtime') ?: ''); ?></td>
            <th>Venue Address</th><td><?php echo htmlspecialchars($get('VenueAddress') ?: ''); ?></td></tr>
        <tr><th>Event Type</th><td><?php echo htmlspecialchars($get('EventType') ?: $get('status')); ?></td>
            <th>Service Name</th><td><?php echo htmlspecialchars($get('ServiceID') ?: $get('service') ?: ''); ?></td></tr>
        <tr><th>Apply Date</th><td><?php echo htmlspecialchars($get('BookingDate') ?: $get('created_at')); ?></td>
            <th>Order Final Status</th>
            <td><?php
                $st = strtolower(trim($get('EventType') ?: $get('status')));
                if ($st === 'approved') echo '<span class="status approved">Approved</span>';
                elseif (strpos($st, 'cancel') !== false) echo '<span class="status cancelled">Cancelled</span>';
                else echo '<span class="status pending">Not Processed Yet</span>';
            ?></td></tr>
        <tr><th>Admin Remark</th><td colspan="3"><?php echo htmlspecialchars($get('AdminRemark') ?: 'Not Updated Yet'); ?></td></tr>
    </table>
    <a class="back" href="request_status.php">← Back</a>
</div>
</body>
</html>
