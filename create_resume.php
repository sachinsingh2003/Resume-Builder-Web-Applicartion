<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}
// Handle image upload
$imageData = null;
if (!empty($_FILES['profile_image']['tmp_name'])) {
    $imageData = addslashes(file_get_contents($_FILES['profile_image']['tmp_name']));
}

include 'Database_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    $about =$_POST['profile'];
    $phn_number= $_POST['Contact'];

    $email = $_POST['email'];

    $school_10 = $_POST['school_10'];
    $Marks_10 = $_POST['marks_10'];
    $school_12 = $_POST['school_12'];

    $Marks_12 = $_POST['marks_12'];
    $Degree = $_POST['Degree'];
    $Degree_Percentage = $_POST['Degree_per'];
    $experience = $_POST['exp'];
    $skills = $_POST['skills'];
    $resume_id = $_SESSION['id'];
    $address = $_POST['address'];

    $language = $_POST['lang'];
    $Gender = $_POST['gender'];
    $Collage_name = $_POST['Collage_name'];
    $template_id = $_POST['template_id'];
    $photo = $_POST['profile_image'];
    $Project = $_POST['project'];
    $Certificate = $_POST['Certificate'];
    $Reff = $_POST['Refer'];




    // Insert the new resume into the database
    $sql = "INSERT INTO resume (name, email, marks_10,marks_12, Degree , Degree_per, exp, skills ,resume_id,address , Collage_name,template_id,profile_details, contact,school_10, school_12,lang,Gender,profile_image,Projects ,Certificate ,	Referance)
            VALUES ('$name', '$email', '$Marks_10', '$Marks_12','$Degree','$Degree_Percentage ','$experience', '$skills','$resume_id','$address','$Collage_name','$template_id','$about','$phn_number','$school_10','$school_12','$language','$Gender','$photo','$Project','$Certificate','$Reff')";

    if ($conn->query($sql) === TRUE) {
        // echo "New resume created successfully! <a href='dashboard.php'>Go back to Dashboard</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Resume</title>
  <link rel="stylesheet" href="create_resume.css">
</head>
<body>
  <div class="container">
    <h1>Create Your Resume</h1>
    <form method="POST" action="create_resume.php">
      
      <h2>Personal Info</h2>
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="Contact" placeholder="Phone Number" required>
      <textarea name="profile" placeholder="About You (Professional Summary)" required></textarea>
      <input type="text" name="address" placeholder="Address" required>
      <input type="text" name="lang" placeholder="Languages Known" required>
      <!-- <input type="text" name="gender" placeholder="Gender" required> -->
      <label for="gender">Gender</label>
      <select name="gender" id="" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>

      <h2>Education</h2>
      <input type="text" name="school_10" placeholder="10th School Name" required>
      <input type="number" name="marks_10" placeholder="10th Marks (%)" required>
      <input type="text" name="school_12" placeholder="12th School Name" required>
      <input type="number" name="marks_12" placeholder="12th Marks (%)" required>
      <input type="text" name="Degree" placeholder="Degree (e.g., B.Tech)" required>
      <input type="number" name="Degree_per" placeholder="Degree Percentage" required>
      <input type="text" name="Collage_name" placeholder="College Name" required>
      
      <h2>Projects</h2>
      <textarea name="project" id="" placeholder="Projects You Work On" required></textarea>

      <h2>Experience & Skills</h2>
      <textarea name="exp" placeholder="Work Experience (List companies, roles, duration)" required></textarea>
      <textarea name="skills" placeholder="Skills (Comma-separated)" required></textarea>

      <h2>Certificate</h2>
      <input type="text"  name="Certificate" placeholder="Certificate..." >

      <h2>Reference</h2>
      <input type="text" name="Refer" placeholder="Ref...." >

      <h2>Choose Template</h2>
      <label for="template_id">Select Template</label>
      <select name="template_id" required>
        <option value="1">Classic Template</option>
        <option value="2">Modern Template</option>
        <option value="3">Creative Template</option>
      </select>


      <h2>Upload Profile Picture</h2>
      <input type="file" name="profile_image" accept="image">
      <?php if (!empty($resume['profile_image'])): ?>
      <img src="data:image/jpeg;base64,<?= base64_encode($resume['profile_image']) ?>" width="100">
      <?php endif; ?>

      <button type="submit" onclick="alert('Resume Generated Succefully!')">Generate Resume</button>
    </form>

    <p><a href="Dashboard.php">⬅ Back to Dashboard</a></p>
  </div>
</body>
</html>

