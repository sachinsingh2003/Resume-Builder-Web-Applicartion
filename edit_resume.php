<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.html");
    exit();
}

include 'Database_config.php';

// $res_id = $_GET['id'];  // This is the unique ID of the resume entry
    $user_id = $_SESSION['id'];

// Fetch the resume to edit
$sql = "SELECT * FROM resume WHERE resume_id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Resume not found or you don't have permission to edit it.";
    exit();
}

$resume = $result->fetch_assoc();

// Handle form submission
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
  $Project = $_POST['project'];
  $Certificate = $_POST['Certificate'];
  $Reff = $_POST['Refer'];
  $photo = null ;
  if(!empty($_FILES['profile_image']['tmp_name'])){
    $photo=addslashes(file_get_contents($_FILES['profile_image']['tmp_name']));
  }

  $update_sql = "UPDATE resume SET 
        name='$name',
        profile_details= '$about' ,
        contact = '$phn_number',
        email='$email', 
        school_10 = '$school_10',
        marks_10='$Marks_10',
        school_12 = '$school_12', 
        marks_12='$Marks_12', 
        Degree='$Degree', 
        Degree_per='$Degree_Percentage', 
        exp='$experience', 
        skills='$skills',
        address='$address',
        lang ='$language',
        Gender ='$Gender',
        Collage_name='$Collage_name',
        template_id = '$template_id',
        Projects='$Project',
        Certificate='$Certificate',
        Referance='$Reff'";

  if ($photo !== null) {
      $update_sql .= ", profile_image='$photo'";
  }
  
    $update_sql .= " WHERE resume_id='$user_id'" ;

    if ($conn->query($update_sql) === TRUE) {
        header("Location: Dashboard.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
      }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Resume</title>
  <link rel="stylesheet" href="edit_resume.css">
</head>
<body>
<div class="container">
    <h1>Edit Your Resume</h1>
    <form method="POST" action="edit_resume.php" enctype="multipart/form-data">
  <h2>Personal Info</h2>
  <input type="text" name="name" value="<?= htmlspecialchars($resume['name']) ?>" placeholder="Full Name" required>
  <input type="email" name="email" value="<?= htmlspecialchars($resume['email']) ?>" placeholder="Email" required>
  <input type="text" name="Contact" value="<?= htmlspecialchars($resume['contact']) ?>" placeholder="Phone Number" required>
  <textarea name="profile" placeholder="About You (Professional Summary)" required><?= htmlspecialchars($resume['profile_details']) ?></textarea>
  <input type="text" name="address" value="<?= htmlspecialchars($resume['address']) ?>" placeholder="Address" required>
  <input type="text" name="lang" value="<?= htmlspecialchars($resume['lang']) ?>" placeholder="Languages Known" required>

  <label for="gender">Gender</label>
  <select name="gender" required>
    <option value="Male" <?= $resume['Gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
    <option value="Female" <?= $resume['Gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
  </select>

  <h2>Education</h2>
  <input type="text" name="school_10" value="<?= htmlspecialchars($resume['school_10']) ?>" placeholder="10th School Name" required>
  <input type="number" name="marks_10" value="<?= htmlspecialchars($resume['marks_10']) ?>" placeholder="10th Marks (%)" required>
  <input type="text" name="school_12" value="<?= htmlspecialchars($resume['school_12']) ?>" placeholder="12th School Name" required>
  <input type="number" name="marks_12" value="<?= htmlspecialchars($resume['marks_12']) ?>" placeholder="12th Marks (%)" required>
  <input type="text" name="Degree" value="<?= htmlspecialchars($resume['Degree']) ?>" placeholder="Degree (e.g., B.Tech)" required>
  <input type="number" name="Degree_per" value="<?= htmlspecialchars($resume['Degree_per']) ?>" placeholder="Degree Percentage" required>
  <input type="text" name="Collage_name" value="<?= htmlspecialchars($resume['Collage_name']) ?>" placeholder="College Name" required>

  <h2>Projects</h2>
    <textarea name="project" placeholder="Projects You Work On..." required><?= htmlspecialchars($resume['Projects']) ?></textarea>

  <h2>Experience & Skills</h2>
  <textarea name="exp" placeholder="Work Experience (List companies, roles, duration)" required><?= htmlspecialchars($resume['exp']) ?></textarea>
  <textarea name="skills" placeholder="Skills (Comma-separated)" required><?= htmlspecialchars($resume['skills']) ?></textarea>

  <h2>Certificate</h2>
    <input type="text" name="Certificate" value="<?= htmlspecialchars($resume['Certificate']) ?>"placeholder="Certificate..." >

  <h2>Reference</h2>
    <input type="text" name="Refer"  value="<?= htmlspecialchars($resume['Referance']) ?>" placeholder="Ref...." >
  
  <h2>Choose Template</h2>
  <label for="template_id">Select Template</label>
  <select name="template_id" required>
    <option value="1" <?= $resume['template_id'] == '1' ? 'selected' : '' ?>>Classic Template</option>
    <option value="2" <?= $resume['template_id'] == '2' ? 'selected' : '' ?>>Modern Template</option>
    <option value="3" <?= $resume['template_id'] == '3' ? 'selected' : '' ?>>Creative Template</option>
  </select>

  <h2>Upload Profile Picture</h2>
  <input type="file" name="profile_image" accept="image">
  <!-- <?php if (!empty($resume['profile_image'])): ?>
    <p>Current Picture</p>
    <img src="data:image/jpeg;base64,<?= base64_encode($resume['profile_image']) ?>" width="100">
  <?php endif; ?> -->

  <button type="submit" onclick="alert('Updated')">Update Resume</button>
</form>


    <p><a href="Dashboard.php">⬅ Back to Dashboard</a></p>
  </div>
</body>
</html>

<?php
$conn->close();
?>
