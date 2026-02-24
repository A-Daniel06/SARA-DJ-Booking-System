<?php include_once __DIR__ . '/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Request Status - SARA DJ Booking</title>
    <style>
        html, body { height: 100%; }
                 body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            /* Full-screen background image */
            background-image: url('images/banner.jpg');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
        }

            /* Dark overlay so white content is readable over the image */
        body::before {
                content: "";
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.45);
                pointer-events: none;
                z-index: 1;
        }

    /* Header */
   header { 
    background: linear-gradient(90deg, #2c3e50, #34495e); 
    color:#fff; 
    padding:20px 0; 
    text-align:right; 
    box-shadow:0 3px 6px rgba(0,0,0,0.2);
}
.header1 { 
    background: linear-gradient(90deg, #2c3e50, #34495e); 
    color:#fff; 
    padding:20px 0; 
    text-align:center; 
    box-shadow:0 3px 6px rgba(0,0,0,0.2);
    
}
header h1 { margin:0; font-size:38px; letter-spacing:1px; }
   nav { margin-top:20px; }
nav a { 
    display:inline-block;
    vertical-align:middle;
    color:#fff; 
    margin:0 15px; 
    text-decoration:none; 
    font-weight:bold; 
    transition:0.3s;
    font-size:18px;
}
nav a:hover { 
    color:#f39c12; 
    text-decoration:underline; 
}
/* Sections */
.section, .section1 { 
    margin:30px auto; 
    max-width:1100px;
    border-radius:12px; 
    box-shadow:0 4px 8px rgba(0,0,0,0.1);
    width:90%; 
    padding:30px;
    background:#fff;
    color:#333;
    position: relative;
    z-index: 2; /* ensure it sits above the overlay */
}
.section h2, .section1 h2 { 
    text-align:center; 
    margin-bottom:20px; 
    color:#2c3e50; 
    font-size:28px;
}

/* Services */
.services { 
    display:flex; 
    justify-content:space-around; 
    flex-wrap:wrap;
    gap:20px;
}
.service-box { 
    width:30%; 
    min-width:280px;
    background:#fdfdfd; 
    padding:25px; 
    border-radius:12px; 
    text-align:center; 
    box-shadow:0 3px 8px rgba(0,0,0,0.1); 
    transition:0.3s;
}
.service-box:hover {
    transform:translateY(-8px);
    box-shadow:0 6px 15px rgba(0,0,0,0.2);
}
.service-box h3 { 
    color:#2c3e50; 
    margin-bottom:10px; 
}
.service-box p { 
    font-size:16px; 
    color:#666; 
}
.service-box a {
    display:inline-block;
    margin-top:15px;
    padding:10px 20px;
    background:#2c3e50;
    color:#fff;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}
.service-box a:hover {
    background:#f39c12;
}

/* Forms (for login, request status, contact) */
.form-container {
    max-width:500px;
    margin:30px auto;
    padding:30px;
    background:#fff;
    border-radius:12px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
    position: relative;
    z-index: 2;
}
.form-container h2 {
    text-align:center;
    margin-bottom:20px;
    color:#2c3e50;
}
.form-container input, 
.form-container textarea, 
.form-container select {
    width:100%;
    padding:12px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:16px;
}
.form-container button {
    width:100%;
    padding:12px;
    background:#2c3e50;
    color:#fff;
    border:none;
    border-radius:6px;
    font-size:18px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}
.form-container button:hover {
    background:#f39c12;
}

/* Footer */
footer { 
    background: linear-gradient(90deg, #2c3e50, #34495e); 
    color:#fff; 
    padding:20px; 
    text-align:center; 
    margin-top:30px; 
    font-size:14px;
}
footer a { 
    color:#f39c12; 
    text-decoration:none; 
    margin:0 8px;
}
footer a:hover {
    text-decoration:underline;
}
/* Center main content */
div[style] {
    max-width: 600px;
    margin: 40px auto;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
}

/* Input styles */
form input {
    display: block;
    width: 100%;
    padding: 14px;
    margin: 12px 0;
    border: 1px solid #bbb;
    border-radius: 6px;
    font-size: 16px;
    transition: 0.3s;
}
form input:focus {
    border-color: #2c3e50;
    outline: none;
    box-shadow: 0 0 6px rgba(44, 62, 80, 0.5);
}

/* Button */
form button {
    display: block;
    width: 100%;
    padding: 14px;
    margin-top: 10px;
    background: linear-gradient(90deg, #2c3e50, #34495e);
    color: #fff;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s ease-in-out;
}
form button:hover {
    background: #f39c12;
    transform: scale(1.03);
}

/* Booking status result */
h3 {
    text-align: center;
    margin-top: 20px;
    padding: 12px;
    border-radius: 8px;
    font-size: 20px;
}
/* status badges */
.status-badge { display:inline-block; padding:8px 14px; border-radius:20px; font-weight:700; }
.status-approved { background:#eafaf1; color:#27ae60; border:1px solid #27ae60; }
.status-cancelled { background:#fdecea; color:#c0392b; border:1px solid #c0392b; }
.status-pending { background:#fff7e6; color:#e67e22; border:1px solid #e67e22; }
h3:contains("Status") {
    background: #eafaf1;
    color: #27ae60;
    border: 1px solid #27ae60;
}
h3:contains("No booking") {
    background: #fdecea;
    color: #c0392b;
    border: 1px solid #c0392b;
}

/* Responsive nav */
@media (max-width: 768px) {
    nav {
        display: flex;
        flex-direction: column;
        gap: 12px;
        text-align: center;
    }
    nav a {
        margin: 5px 0;
        font-size: 16px;
    }
}

/* Smooth transitions */
* {
    transition: all 0.2s ease-in-out;
}


    </style>
</head>
<body>
<header>
    <h1 class="header1">Check Request Status</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="services.php">DJ Services</a>
        <a href="request_status.php">Request Status</a>
        <a href="contact.php">Contact</a>
        <a href="admin_login.php">Admin Login</a>
    </nav>
</header>
<div class="form-container enhanced-form colorful-form" style="box-shadow: 0 6px 24px rgba(44,62,80,0.13); border: 1px solid #2ecc71;">
    <form method="post" action="">
        <input 
            type="text" 
            name="username" 
            placeholder="Enter Username" 
            required 
            style="background: #34495e; color: #fff; font-weight: 500; border: 1.5px solid #2ecc71; box-shadow: 0 1px 4px rgba(44,62,80,0.06);"
        >
        <input 
            type="text" 
            name="mobile" 
            placeholder="Enter Mobile No" 
            required 
            style="background: #34495e; color: #fff; font-weight: 500; border: 1.5px solid #2ecc71; box-shadow: 0 1px 4px rgba(44,62,80,0.06);"
        >
        <button 
            type="submit" 
            name="check"
            style="background: linear-gradient(90deg, #2ecc71 60%, #34495e 100%); letter-spacing: 1px; box-shadow: 0 2px 8px rgba(44,62,80,0.08); border: 1.5px solid #2ecc71; color: #fff;"
        >Check Status</button>
    </form>
</div>
<style>
.enhanced-form {
    animation: fadeInDown 0.7s;
    border-radius: 16px !important;
    background: linear-gradient(120deg, #34495e 60%, #2ecc71 100%);
    border: 1.5px solid #2ecc71 !important;
    box-shadow: 0 8px 32px rgba(44,62,80,0.13) !important;
    color: #fff !important;
}
.colorful-form {
    background: linear-gradient(135deg, #34495e 60%, #2ecc71 100%) !important;
    color: #fff !important;
}
.enhanced-form input,
.enhanced-form input::placeholder {
    color: #fff !important;
}
.enhanced-form input:focus, .enhanced-form input:hover {
    border-color: #2ecc71 !important;
    background: #2c3e50 !important;
    color: #fff !important;
    box-shadow: 0 0 8px #2ecc7133;
}
.enhanced-form button {
    border-radius: 8px !important;
    font-size: 19px !important;
    font-family: 'Segoe UI', Arial, sans-serif;
    transition: background 0.3s, transform 0.2s;
    color: #fff !important;
}
.enhanced-form button:hover {
    background: linear-gradient(90deg, #34495e 60%, #2ecc71 100%) !important;
    color: #fff;
    transform: translateY(-2px) scale(1.04);
    box-shadow: 0 4px 16px #2ecc7133;
}
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-40px);}
    to { opacity: 1; transform: translateY(0);}
}
</style>

    <?php
    if (isset($_POST['check'])) {
        $u = trim($_POST['username']);
        $m = trim($_POST['mobile']);

        // First try tblbooking (new schema)
        $found = false;
        // Try selecting Email directly from tblbooking if column exists
        if ($stmt = mysqli_prepare($conn, "SELECT ID, BookingID, EventType, Name, MobileNumber, BookingDate, Email FROM tblbooking WHERE Name = ? AND MobileNumber = ? LIMIT 1")) {
            mysqli_stmt_bind_param($stmt, 'ss', $u, $m);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $etype = $row['EventType'];
                $bid = $row['BookingID'];
                $bdate = $row['BookingDate'];
                // obtain email: prefer Email from tblbooking, fallback to users lookup
                $email = '';
                if (!empty($row['Email'])) {
                    $email = $row['Email'];
                } else {
                    // try to fetch from users table by name or mobile
                    if ($s2 = mysqli_prepare($conn, "SELECT email FROM users WHERE username = ? OR mobile = ? LIMIT 1")) {
                        mysqli_stmt_bind_param($s2, 'ss', $u, $m);
                        mysqli_stmt_execute($s2);
                        $r2 = mysqli_stmt_get_result($s2);
                        if ($r2 && mysqli_num_rows($r2) > 0) {
                            $rr = mysqli_fetch_assoc($r2);
                            $email = isset($rr['email']) ? $rr['email'] : '';
                        }
                        mysqli_stmt_close($s2);
                    }
                }
                // render as table row similar to screenshot
                echo '<div class="results-wrapper">';
                echo '<table class="status-table">';
                echo '<thead><tr><th>Booking Number</th><th>Client Name</th><th>Mobile Number</th><th>Email</th><th>Action</th></tr></thead>';
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . htmlspecialchars($bid) . '</td>';
                echo '<td>' . htmlspecialchars($row['Name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['MobileNumber']) . '</td>';
                echo '<td>' . htmlspecialchars($email) . '</td>';
                echo '<td><a class="view-btn" href="view_details.php?id=' . urlencode($row['ID']) . '">View Details</a></td>';
                echo '</tr>';
                echo '</tbody></table></div>';
                $found = true;
            }
            mysqli_stmt_close($stmt);
        } else {
            // If selecting Email column failed (column may not exist), try without Email then lookup users table for email
            if ($stmtA = mysqli_prepare($conn, "SELECT ID, BookingID, EventType, Name, MobileNumber, BookingDate FROM tblbooking WHERE Name = ? AND MobileNumber = ? LIMIT 1")) {
                mysqli_stmt_bind_param($stmtA, 'ss', $u, $m);
                mysqli_stmt_execute($stmtA);
                $resA = mysqli_stmt_get_result($stmtA);
                if ($resA && mysqli_num_rows($resA) > 0) {
                    $row = mysqli_fetch_assoc($resA);
                    $bid = $row['BookingID'];
                    // lookup email in users
                    $email = '';
                    if ($s3 = mysqli_prepare($conn, "SELECT email FROM users WHERE username = ? OR mobile = ? LIMIT 1")) {
                        mysqli_stmt_bind_param($s3, 'ss', $u, $m);
                        mysqli_stmt_execute($s3);
                        $r3 = mysqli_stmt_get_result($s3);
                        if ($r3 && mysqli_num_rows($r3) > 0) {
                            $rr = mysqli_fetch_assoc($r3);
                            $email = isset($rr['email']) ? $rr['email'] : '';
                        }
                        mysqli_stmt_close($s3);
                    }
                    echo '<div class="results-wrapper">';
                    echo '<table class="status-table">';
                    echo '<thead><tr><th>Booking Number</th><th>Client Name</th><th>Mobile Number</th><th>Email</th><th>Action</th></tr></thead>';
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($bid) . '</td>';
                    echo '<td>' . htmlspecialchars($row['Name']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['MobileNumber']) . '</td>';
                    echo '<td>' . htmlspecialchars($email) . '</td>';
                    echo '<td><a class="view-btn" href="view_booking.php?id=' . urlencode($row['ID']) . '">View Details</a></td>';
                    echo '</tr>';
                    echo '</tbody></table></div>';
                    $found = true;
                }
                mysqli_stmt_close($stmtA);
            }
        }

        // Fallback to older bookings table
        if (!$found) {
            if ($stmt2 = mysqli_prepare($conn, "SELECT id, username, mobile, status, created_at, email FROM bookings WHERE username = ? AND mobile = ? LIMIT 1")) {
                mysqli_stmt_bind_param($stmt2, 'ss', $u, $m);
                mysqli_stmt_execute($stmt2);
                $res2 = mysqli_stmt_get_result($stmt2);
                if ($res2 && mysqli_num_rows($res2) > 0) {
                    $r = mysqli_fetch_assoc($res2);
                    $status = $r['status'];
                    $created = $r['created_at'];
                    $badgeClass = 'status-pending';
                    if (stripos($status, 'approved') !== false) $badgeClass = 'status-approved';
                    if (stripos($status, 'cancel') !== false) $badgeClass = 'status-cancelled';
                    // render legacy booking as a table row
                    echo '<div class="results-wrapper">';
                    echo '<table class="status-table">';
                    echo '<thead><tr><th>Booking Number</th><th>Client Name</th><th>Mobile Number</th><th>Email</th><th>Action</th></tr></thead>';
                    echo '<tbody>';
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($r['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($r['username']) . '</td>';
                    echo '<td>' . htmlspecialchars($r['mobile']) . '</td>';
                    echo '<td>' . (isset($r['email']) ? htmlspecialchars($r['email']) : '') . '</td>';
                    echo '<td><a class="view-btn" href="view_details.php?id=' . urlencode($r['id']) . '">View Details</a></td>';
                    echo '</tr>';
                    echo '</tbody></table></div>';
                    $found = true;
                }
                mysqli_stmt_close($stmt2);
            }
        }

        if (!$found) {
            echo '<h3 style="background:#fdecea;color:#c0392b;border:1px solid #c0392b;">No booking found!</h3>';
        }
    }
    ?>

    <style>
    /* Results table styling similar to screenshot */
    .status-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 18px;
        background: #fff;
        color: #333;
    }
    .status-table thead th {
        background: #fff;
        color: #333;
        padding: 14px 12px;
        text-align: left;
        border-bottom: 2px solid rgba(0,0,0,0.06);
    }
    .status-table tbody td {
        padding: 18px 12px;
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }
    .status-table tbody tr:last-child td { border-bottom: none; }
    .view-btn {
        display:inline-block;
        padding:10px 16px;
        background:#5bc0de;
        color:#fff;
        border-radius:6px;
        text-decoration:none;
        box-shadow:0 4px 8px rgba(0,0,0,0.12);
    }
    .view-btn:hover { transform:translateY(-2px); }
    .results-wrapper { max-width:1100px; margin:20px auto; }
        .results-wrapper { position: relative; z-index: 2; }
    </style>

<footer>
    <p>&copy; 2025 SARA DJ Booking. All Rights Reserved.</p>
</footer>
</body>
</html>
