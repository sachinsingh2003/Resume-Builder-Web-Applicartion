<?php
// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

// Include the database connection
include 'Database_config.php';

// Get the logged-in user's ID
$user_id = $_SESSION['id'];

// Fetch resumes for the logged-in user
$sql = "SELECT * FROM resume WHERE resume_id='$user_id' ";
$result = $conn->query($sql);

// echo "Logged in as: " . $_SESSION['username']; // Display user info for debugging
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <div class="container">
  <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    
    <!-- Navigation Links -->
    <!-- <a href="template.php">Choose Template</a> | -->

    <h2>Your Resumes</h2>
    <ul>
      <?php
      if ($result->num_rows > 0) {
        // Display existing resumes
        while ($row = $result->fetch_assoc()) {
          echo "<div class='resume-entry'>";
          echo "<strong>Resume Name:</strong> " . htmlspecialchars($row['name']) . " | ";
          echo "<a href='edit_resume.php?id=" . $row['resume_id'] . "'>Edit</a> | ";
          echo "<a href='delete_resume.php?id=" . $row['resume_id'] . "' onclick='return confirm(\"Are you sure?\");'>Delete</a> | ";
          echo "<a href='preview.php?id=" . $row['resume_id'] . "' target='_blank'>Preview</a>";
          echo "</div><br>";
      }
    } else {
        // If no resumes are found, offer the option to create a new resume
        echo "<p>You have no resumes yet.<a href='create_resume.php'>Create one now</a>.</p>";
    }
   
      ?>    
    </ul>
    <p><a href="logout.php" style="color: red; text-decoration: none;">Logout</a></p>

    <!-- <a href="create_resume.php">Create New Resume</a> -->
  </div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
