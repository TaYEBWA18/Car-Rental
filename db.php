<?php
// db.php - Database connection
$host = 'localhost';
$user = 'root'; // Change if your MySQL user is different
$pass = '';    // Change if your MySQL password is set
$db = 'rentalapp';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?> 