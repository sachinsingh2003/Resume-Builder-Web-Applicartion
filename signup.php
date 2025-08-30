<?php
// Include database connection
include 'Database_config.php';

// Get user input from the form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if passwords match
if ($password !== $confirm_password) {
  echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
  exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if email already exists
$sql = "SELECT * FROM user_data WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<script>alert('Email already registered!');</script>";
    header("Location: login.html");
  exit();
}

// Insert user data into the database
$sql = "INSERT INTO user_data (user_name, email, password) VALUES ('$username', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
  // Redirect to login page after successful registration
  header("Location: login.html");
  exit();
} else {
  echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>
