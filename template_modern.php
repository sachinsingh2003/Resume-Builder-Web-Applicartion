<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Modern Template</title>
  <link rel="stylesheet" href="template_modern.css">
</head>
<body>
<div class="resume-container" id="resumeContent">
  <aside class="sidebar">
    <div class="profile-pic">
      <?php if (!empty($resume['profile_image'])): ?>
        <img src="data:image/jpeg;base64,<?= base64_encode($resume['profile_image']) ?>" alt="Profile Picture">
      <?php else: ?>
        <img src="default_profile.png" alt="Default Picture">
      <?php endif; ?>    
    </div>
    <div class="section contact">
      <h3>CONTACT</h3>
      <p>📞 <?= htmlspecialchars($resume['contact']) ?></p>
      <p>📧 <?= htmlspecialchars($resume['email']) ?></p>
      <p>🏠 <?= htmlspecialchars($resume['address']) ?></p>
    </div>

    <div class="section education">
      <h3>EDUCATION</h3>
      <p><strong><?= htmlspecialchars($resume['school_10']) ?></strong><br>10th - <?= htmlspecialchars($resume['marks_10']) ?>%</p>
      <p><strong><?= htmlspecialchars($resume['school_12']) ?></strong><br>12th - <?= htmlspecialchars($resume['marks_12']) ?>%</p>
      <p><strong><?= htmlspecialchars($resume['Collage_name']) ?></strong><br><?= htmlspecialchars($resume['Degree']) ?> - <?= htmlspecialchars($resume['Degree_per']) ?>%</p>
    </div>

    <div class="section hobbies">
      <h3>HOBBIES</h3>
      <p><?= htmlspecialchars($resume['lang']) ?></p>
    </div>

    <div class="section ">
      <h3>SKILLS</h3>
      <p><?= htmlspecialchars($resume['skills']) ?></p>
    </div>
  </aside>

  <main class="main-content">
    <header>
      <h1><?= htmlspecialchars($resume['name']) ?></h1>
      <p>Programmer / UI Developer</p>
    </header>

    <section>
      <h2>ABOUT ME</h2>
      <p><?= nl2br(htmlspecialchars($resume['profile_details'])) ?></p>
    </section>

    <section>
      <h2>EXPERIENCE</h2>
      <p><?= nl2br(htmlspecialchars($resume['exp'])) ?></p>
    </section>

    <section>
      <h2>Projects</h2>
      <p><?= nl2br(htmlspecialchars($resume['Projects']))?></p>
    </section>

    <section>
      <h2>Certificate</h2>
      <p><?= nl2br(htmlspecialchars($resume['Certificate']))?></p>
    </section>
    
    <section>
      <h2>Referance</h2>
      <p><?= nl2br(htmlspecialchars($resume['Referance']))?></p>
    </section>
  </main>
</div>

<button id="downloadBtn" class="dwnBtn">Download as PDF</button>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

  <script>
    document.getElementById("downloadBtn").addEventListener("click", function () {
      const element = document.getElementById("resumeContent");

      const opt = {
        margin: [0.5,0.5,0.5,0.5],
        filename: 'resume.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' },
        pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
      };

      html2pdf().set(opt).from(element).save();
    });
  </script>
</body>
</html>
