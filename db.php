<?php
$host = "sql100.infinityfree.com";  
$username = "if0_41243771";  
$password = "5x2RiL2oe3";  
$database = "if0_41243771_sara_dj";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>