<?php
session_start();
require_once __DIR__ . '/../includes/dbconnection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Read Queries</title>
    <style>
        body{margin:0;font-family:Segoe UI,Arial,sans-serif;background:#f0f0f3;min-height:100vh}
        .topbar{background:#2c3e50;color:#fff;padding:20px;text-align:center;font-size:1.6rem;font-weight:700}
        .container{max-width:1100px;margin:20px auto;background:#fff;border-radius:12px;padding:18px}
        table{width:100%;border-collapse:separate;border-spacing:0;color:#333}
        th,td{padding:12px 14px;border-bottom:1px solid #eee;text-align:left}
        th{background:#ecf0f1}
        .status-read{background:#2ecc71;color:#fff;padding:6px 10px;border-radius:10px;font-weight:700}
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="topbar">Read Queries</div>
<div class="container">
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Status</th></tr>
        <?php
        try {
            $stmt = $dbh->prepare("SELECT id,name,email,message,status,created_at FROM contact_queries WHERE status = 'Read' ORDER BY created_at DESC");
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($rows && count($rows) > 0) {
                foreach ($rows as $r) {
                    $id = (int)$r['id'];
                    $name = htmlspecialchars($r['name']);
                    $email = htmlspecialchars($r['email']);
                    $message = nl2br(htmlspecialchars($r['message']));
                    echo "<tr>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$name}</td>";
                    echo "<td>{$email}</td>";
                    echo "<td style='max-width:520px; white-space:pre-wrap'>{$message}</td>";
                    echo "<td><span class='status-read'>Read</span></td>";
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="5" style="text-align:center;padding:20px;">No read queries.</td></tr>';
            }
        } catch (PDOException $e) {
            if ($e->getCode() === '42S02') {
                echo '<tr><td colspan="5" style="text-align:center;padding:20px;color:#b00020;">';
                echo 'Contact table not found. <a href="create_contact_table.php?redirect=read" style="color:#2c78d6;text-decoration:underline;">Create contact_queries table</a> to continue.';
                echo '</td></tr>';
            } else {
                echo '<tr><td colspan="5" style="text-align:center;paddin g:20px;color:#b00020;">Error: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
            }
        } catch (Exception $e) {
            echo '<tr><td colspan="5" style="text-align:center;padding:20px;color:#b00020;">Error: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
        }
        ?>
    </table>
    <div style='margin-top:12px;text-align:right;'><a href='unread_queries.php'><button style='padding:8px 12px;border-radius:8px;border:none;background:#3498db;color:#fff'>View Unread</button></a></div>
</div>
</body>
</html>
