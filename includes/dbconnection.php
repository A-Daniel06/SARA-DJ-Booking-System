<?php
$dsn = 'mysql:host=localhost;dbname=sara_dj'; // Update dbname if needed
$username = 'root'; // Update if your DB user is different
$password = '';
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);
try {
    $dbh = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>
