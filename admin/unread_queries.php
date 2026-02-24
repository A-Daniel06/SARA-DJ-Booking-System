<?php
session_start();
require_once __DIR__ . '/../includes/dbconnection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Unread Queries</title>
    <style>
        body{margin:0;font-family:Segoe UI,Arial,sans-serif;background:linear-gradient(135deg,#8e2de2 0%,#4a00e0 100%);min-height:100vh}
        .topbar{background:rgba(30,30,60,0.95);color:#fff;padding:20px;text-align:center;font-size:1.6rem;font-weight:700}
        .container{max-width:1100px;margin:20px auto;background:rgba(161,104,218,0.98);border-radius:12px;padding:18px}
        table{width:100%;border-collapse:separate;border-spacing:0;background:#181828;color:#fff;border-radius:8px;overflow:hidden}
        th,td{padding:12px 14px;border-bottom:1px solid #3a3a5a;text-align:left}
        th{background:linear-gradient(90deg,#e67e22 60%,#f7971e 100%)}
        .status-unread{background:#e67e22;color:#fff;padding:6px 10px;border-radius:10px;font-weight:700}
        .action-btn{padding:8px 12px;border-radius:8px;border:none;cursor:pointer;background:#2980b9;color:#fff}
    </style>
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="topbar">Unread Queries</div>
<div class="container">
    <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Status</th><th>Action</th></tr>
        <?php
        try {
            $stmt = $dbh->prepare("SELECT id,name,email,message,status,created_at FROM contact_queries WHERE status = 'Unread' ORDER BY created_at DESC");
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
                    echo "<td style='max-width:360px; white-space:pre-wrap'>{$message}</td>";
                    echo "<td><span class='status-unread'>Unread</span></td>";
                    echo "<td><a href='mark_query_read.php?id={$id}'><button class='action-btn'>Mark as Done</button></a></td>";
                    echo "</tr>";
                }
            } else {
                echo '<tr><td colspan="6" style="text-align:center;padding:20px;">No unread queries.</td></tr>';
            }
        } catch (PDOException $e) {
            // Table not found error (SQLSTATE 42S02)
            if ($e->getCode() === '42S02') {
                echo '<tr><td colspan="6" style="text-align:center;padding:20px;color:#ffd2d2;">';
                echo 'Contact table not found. <a href="create_contact_table.php?redirect=unread" style="color:#fff;text-decoration:underline;">Create contact_queries table</a> to continue.';
                echo '</td></tr>';
            } else {
                echo '<tr><td colspan="6" style="text-align:center;padding:20px;color:#ffd2d2;">Error: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
            }
        } catch (Exception $e) {
            echo '<tr><td colspan="6" style="text-align:center;padding:20px;color:#ffd2d2;">Error: ' . htmlspecialchars($e->getMessage()) . '</td></tr>';
        }
        ?>
    </table>
    <div style='margin-top:12px;text-align:right;'><a href='read_queries.php'><button class='action-btn' style='background:#2ecc71'>View Read Queries</button></a></div>
</div>
<!-- Font Awesome for the optional icon in buttons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
