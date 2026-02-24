<?php
// Safe script to create the contact_queries table if missing.
// Usage: create_contact_table.php?redirect=unread or ?redirect=read
require_once __DIR__ . '/../includes/dbconnection.php';

$redirect = isset($_GET['redirect']) && in_array($_GET['redirect'], ['unread','read']) ? $_GET['redirect'] : 'unread';

$sql = "CREATE TABLE IF NOT EXISTS contact_queries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('Unread','Read') DEFAULT 'Unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";

try {
    $dbh->exec($sql);
    // Redirect back to the chosen page so admin sees the new table contents
    if ($redirect === 'read') {
        header('Location: read_queries.php');
    } else {
        header('Location: unread_queries.php');
    }
    exit;
} catch (Exception $e) {
    echo "Failed to create table: " . htmlspecialchars($e->getMessage());
    exit;
}
