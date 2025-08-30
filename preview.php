<?php
session_start();
include 'Database_config.php';

// Ensure resume ID and user session are set
if (!isset($_GET['id']) || !isset($_SESSION['id'])) {
    echo "Invalid request.";
    exit();
}

// $resume_id = $_GET['id'];
$user_id = $_SESSION['id'];

// Make sure each resume belongs to the logged-in user
$sql = "SELECT * FROM resume WHERE resume_id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Resume not found or access denied.";
    exit();
}

$resume = $result->fetch_assoc();
$template_id = $resume['template_id'];

// Pass the resume data to the specific template page
switch ($template_id) {
    case 1:
        include 'template_classic.php';
        break;
    case 2:
        include 'template_modern.php';
        break;
    case 3:
        include 'template_creative.php';
        break;
    default:
        echo "Invalid template selected.";
        break;
}
?>

  <!-- <button id="downloadBtn">Download as PDF</button>

  <script>
    document.getElementById("downloadBtn").addEventListener("click", function () {
      const element = document.getElementById("resumeContent");
      html2pdf().from(element).save("resume.pdf");
    });
  </script> -->

</body>
</html>
