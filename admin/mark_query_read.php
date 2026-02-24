<?php
session_start();
require_once __DIR__ . '/../includes/dbconnection.php';

// Validate id parameter
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
	header('Location: unread_queries.php');
	exit;
}

try {
	$stmt = $dbh->prepare('UPDATE contact_queries SET status = :status WHERE id = :id');
	$stmt->execute([':status' => 'Read', ':id' => $id]);
} catch (Exception $e) {
	// optionally log error
}

header('Location: unread_queries.php');
exit;

