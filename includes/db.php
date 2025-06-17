<?php
$host = 'localhost';
$db   = 'miss_grand_tanzania';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("DB connection failed: " . $conn->connect_error);
}
?>
