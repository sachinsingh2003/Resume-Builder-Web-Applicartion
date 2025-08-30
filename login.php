<?php
// Start session
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
include 'Database_config.php';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if email exists in the database
    $sql = "SELECT * FROM user_data WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // use prepared statement for security
    $stmt->execute();
    $result = $stmt->get_result();

    // If user found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password (assuming it is hashed in DB)
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['id'] = $user['user_id'];
            $_SESSION['username'] = $user['user_name'];

            // Redirect to dashboard
            header("Location: Dashboard.php");
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password!'); window.location.href='login.html';</script>";
        }
    } else {
        // Email not found
        echo "<script>alert('No account found with that email!'); window.location.href='login.html';</script>";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
