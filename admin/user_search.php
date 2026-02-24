<?php
session_start();
require_once __DIR__ . '/../includes/dbconnection.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>User / Booking Search</title>
  <style>
    body { margin: 0; font-family: 'Segoe UI', Arial, sans-serif; background: #eaf3fb; min-height: 100vh; }
    .topbar { background: #2563eb; color: #fff; padding: 32px 0 24px 0; text-align: center; font-size: 2.2rem; font-weight: bold; }
    .container { max-width: 1000px; margin: 28px auto; background: #f4faff; border-radius: 12px; padding: 24px; }
    form { display:flex; gap:12px; align-items:center; margin-bottom:18px }
    form input[type="text"]{ padding:10px 12px; font-size:1rem; width:360px }
    form button{ padding:10px 14px; background:#22c55e; color:#fff; border:none; border-radius:6px }
    table{ width:100%; border-collapse:collapse; margin-top:12px }
    th,td{ padding:10px 12px; border:1px solid #ddd; text-align:left }
    th{ background:#2563eb; color:#fff }
    .invalid-msg{ margin-top:12px; padding:10px 12px; background:#ef4444; color:#fff; border-radius:6px }
  </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="topbar">User / Booking Search</div>
<div class="container">
  <form method="post" action="">
    <input type="text" name="keyword" placeholder="Enter Booking ID, username, email, or mobile" />
    <button type="submit">Search</button>
  </form>

  <?php
    // Processing and output
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $kw = trim($_POST['keyword']);
        if ($kw === '') {
            echo '<div class="invalid-msg">Please enter a search value.</div>';
        } else {
            $like = '%' . str_replace('%', '\\%', $kw) . '%';
            $foundAny = false;

            // 1) Try Booking ID in tblbooking
            try {
                $stmtB = $dbh->prepare('SELECT BookingID, Name, MobileNumber, Email, EventDate, EventType, VenueAddress, BookingDate FROM tblbooking WHERE BookingID = :exact OR BookingID LIKE :like LIMIT 200');
                $stmtB->bindParam(':exact', $kw, PDO::PARAM_STR);
                $stmtB->bindParam(':like', $like, PDO::PARAM_STR);
                $stmtB->execute();
                $bookings = $stmtB->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($bookings)) {
                    echo '<h3>Booking Results</h3>';
                    echo '<table><tr><th>BookingID</th><th>Name</th><th>Mobile</th><th>Email</th><th>Event Date</th><th>Event Type</th><th>Venue</th><th>Booked At</th></tr>';
                    foreach ($bookings as $b) {
                        echo '<tr>' .
                             '<td>' . htmlspecialchars($b['BookingID']) . '</td>' .
                             '<td>' . htmlspecialchars($b['Name']) . '</td>' .
                             '<td>' . htmlspecialchars($b['MobileNumber']) . '</td>' .
                             '<td>' . htmlspecialchars($b['Email']) . '</td>' .
                             '<td>' . htmlspecialchars($b['EventDate']) . '</td>' .
                             '<td>' . htmlspecialchars($b['EventType']) . '</td>' .
                             '<td>' . htmlspecialchars($b['VenueAddress']) . '</td>' .
                             '<td>' . htmlspecialchars($b['BookingDate']) . '</td>' .
                             '</tr>';
                    }
                    echo '</table>';
                    $foundAny = true;
                }
            } catch (PDOException $e) {
                if ($e->getCode() !== '42S02') {
                    echo '<div class="invalid-msg">Database error (tblbooking): ' . htmlspecialchars($e->getMessage()) . '</div>';
                }
            }

            // 1b) If BookingID search returned nothing, also search tblbooking by Name / MobileNumber / Email
            if (!$foundAny) {
                try {
                    $stmtB2 = $dbh->prepare('SELECT BookingID, Name, MobileNumber, Email, EventDate, EventType, VenueAddress, BookingDate FROM tblbooking WHERE Name LIKE :kw OR MobileNumber LIKE :kw OR Email LIKE :kw LIMIT 200');
                    $stmtB2->bindParam(':kw', $like, PDO::PARAM_STR);
                    $stmtB2->execute();
                    $bookings2 = $stmtB2->fetchAll(PDO::FETCH_ASSOC);
                    if (!empty($bookings2)) {
                        echo '<h3>Booking Results (matched by name/mobile/email)</h3>';
                        echo '<table><tr><th>BookingID</th><th>Name</th><th>Mobile</th><th>Email</th><th>Event Date</th><th>Event Type</th><th>Venue</th><th>Booked At</th></tr>';
                        foreach ($bookings2 as $b) {
                            echo '<tr>' .
                                 '<td>' . htmlspecialchars($b['BookingID']) . '</td>' .
                                 '<td>' . htmlspecialchars($b['Name']) . '</td>' .
                                 '<td>' . htmlspecialchars($b['MobileNumber']) . '</td>' .
                                 '<td>' . htmlspecialchars($b['Email']) . '</td>' .
                                 '<td>' . htmlspecialchars($b['EventDate']) . '</td>' .
                                 '<td>' . htmlspecialchars($b['EventType']) . '</td>' .
                                 '<td>' . htmlspecialchars($b['VenueAddress']) . '</td>' .
                                 '<td>' . htmlspecialchars($b['BookingDate']) . '</td>' .
                                 '</tr>';
                        }
                        echo '</table>';
                        $foundAny = true;
                    }
                } catch (PDOException $e) {
                    if ($e->getCode() !== '42S02') {
                        echo '<div class="invalid-msg">Database error (tblbooking search): ' . htmlspecialchars($e->getMessage()) . '</div>';
                    }
                }
            }

            // 2) If no booking found, search users table (dynamic columns)
            if (!$foundAny) {
                $users = [];
                try {
                    // Inspect available columns to avoid unknown-column errors
                    $colStmt = $dbh->query("SHOW COLUMNS FROM users");
                    $cols = $colStmt->fetchAll(PDO::FETCH_COLUMN, 0);

                    // Decide which columns to select and search
                    $selectCols = [];
                    $searchCols = [];
                    if (in_array('id', $cols)) $selectCols[] = 'id';
                    if (in_array('username', $cols)) { $selectCols[] = 'username'; $searchCols[] = 'username'; }
                    if (in_array('email', $cols)) { $selectCols[] = 'email'; $searchCols[] = 'email'; }
                    if (in_array('mobile', $cols)) { $selectCols[] = 'mobile'; $searchCols[] = 'mobile'; }

                    if (!empty($selectCols) && !empty($searchCols)) {
                        $selectSql = implode(', ', $selectCols);
                        $whereParts = array_map(function($c){ return "$c LIKE :kw"; }, $searchCols);
                        $sql = "SELECT $selectSql FROM users WHERE " . implode(' OR ', $whereParts) . " LIMIT 200";
                        $stmt = $dbh->prepare($sql);
                        $stmt->bindParam(':kw', $like, PDO::PARAM_STR);
                        $stmt->execute();
                        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        // users table exists but has unexpected schema
                        echo '<div class="invalid-msg">Users table exists but has no searchable columns (username/email/mobile).</div>';
                    }

                    if (!empty($users)) {
                        echo '<h3>User Results</h3>';
                        echo '<table><tr>';
                        foreach ($selectCols as $c) {
                            echo '<th>' . htmlspecialchars(ucfirst($c)) . '</th>';
                        }
                        echo '</tr>';
                        foreach ($users as $u) {
                            echo '<tr>';
                            foreach ($selectCols as $c) {
                                $val = isset($u[$c]) ? $u[$c] : '';
                                echo '<td>' . htmlspecialchars($val) . '</td>';
                            }
                            echo '</tr>';
                        }
                        echo '</table>';
                        $foundAny = true;
                    }

                } catch (PDOException $e) {
                    if ($e->getCode() === '42S02') {
                        echo '<div class="invalid-msg">Users table not found. Please import the SQL schema.</div>';
                    } else {
                        echo '<div class="invalid-msg">Database error (users): ' . htmlspecialchars($e->getMessage()) . '</div>';
                    }
                }
            }

            // 3) Fallback: search bookings table for username/mobile
            if (!$foundAny) {
                try {
                    $stmt2 = $dbh->prepare('SELECT id, username, mobile, service, status, created_at FROM bookings WHERE username LIKE :kw OR mobile LIKE :kw LIMIT 200');
                    $stmt2->bindParam(':kw', $like, PDO::PARAM_STR);
                    $stmt2->execute();
                    $bks = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    if (!empty($bks)) {
                        echo '<h3>Bookings (fallback) Results</h3>';
                        echo '<table><tr><th>ID</th><th>Username</th><th>Mobile</th><th>Service</th><th>Status</th><th>Created</th></tr>';
                        foreach ($bks as $bb) {
                            echo '<tr>' .
                                 '<td>' . htmlspecialchars($bb['id']) . '</td>' .
                                 '<td>' . htmlspecialchars($bb['username']) . '</td>' .
                                 '<td>' . htmlspecialchars($bb['mobile']) . '</td>' .
                                 '<td>' . htmlspecialchars($bb['service']) . '</td>' .
                                 '<td>' . htmlspecialchars($bb['status']) . '</td>' .
                                 '<td>' . htmlspecialchars($bb['created_at']) . '</td>' .
                                 '</tr>';
                        }
                        echo '</table>';
                        $foundAny = true;
                    }
                } catch (PDOException $e) {
                    // ignore fallback errors
                }
            }

            if (!$foundAny) {
                echo '<div class="invalid-msg">No records found matching: ' . htmlspecialchars($kw) . '</div>';
            }
        }
    }
  ?>

</div>
</body>
</html>
