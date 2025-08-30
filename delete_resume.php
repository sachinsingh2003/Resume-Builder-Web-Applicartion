<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

// Include database connection
include 'Database_config.php';

// Get the resume ID from URL
// $resume_id = $_GET['id'];

// Delete the resume from the database
$sql = "DELETE FROM resume WHERE resume_id='" . $_SESSION['id'] . "'";

if ($conn->query($sql) === TRUE) {
    // Redirect back to dashboard
    header("Location: Dashboard.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
