<?php
// db_config.php

$host = "localhost";       // Usually localhost on XAMPP
$username = "root";        // Default username in XAMPP
$password = "admin@1349";            // No password by default
$dbname = "new_resume";     // Name of the database

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
