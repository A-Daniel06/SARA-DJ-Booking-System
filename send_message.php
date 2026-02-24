
<?php

// Handle contact form submissions and insert into contact_queries table
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('Location: contact.php');
	exit;
}

require_once __DIR__ . '/includes/dbconnection.php';

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if ($name === '' || $email === '' || $message === '') {
	header('Location: contact.php?error=1');
	exit;
}

// Ensure table exists (safe to run repeatedly)
$create = "CREATE TABLE IF NOT EXISTS contact_queries (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	message TEXT NOT NULL,
	status ENUM('Unread','Read') DEFAULT 'Unread',
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";
$dbh->exec($create);

try {
	$stmt = $dbh->prepare('INSERT INTO contact_queries (name,email,message,status) VALUES (:name,:email,:message,:status)');
	$status = 'Unread';
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':message', $message);
	$stmt->bindParam(':status', $status);
	$stmt->execute();
	header('Location: contact.php?sent=1');
	exit;
} catch (Exception $e) {
	// fallback: redirect with error
	header('Location: contact.php?error=1');
	exit;
}
