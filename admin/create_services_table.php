<?php
// Lightweight admin helper to create the `services` table if it doesn't exist.
// Visit this file (while running XAMPP) to create the table automatically.

// Basic protection: require a local request or adjust to your admin auth.
if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1' && $_SERVER['REMOTE_ADDR'] !== '::1') {
    echo "This script must be run locally.";
    exit();
}

$mysqli = new mysqli('localhost', 'root', '', 'sara_dj');
if ($mysqli->connect_errno) {
    die('Connect error: ' . $mysqli->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";

if ($mysqli->query($sql) === TRUE) {
    echo "<h3>services table created (or already exists).</h3>";
} else {
    echo "<h3>Error creating table:</h3> " . htmlspecialchars($mysqli->error);
}

echo '<p><a href="all_booking.php">Back to Admin</a></p>';
$mysqli->close();

?>
