

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Classic Template</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

  <link rel="stylesheet" href="template_classic.css">
</head>
<body>

  <div class="resume" id="resumeContent">
    <header>
      <h1><?= htmlspecialchars($resume['name']) ?></h1>
      <p><?= htmlspecialchars($resume['email']) ?> | <?= htmlspecialchars($resume['contact']) ?> | <?= htmlspecialchars($resume['address']) ?></p>
    </header>

    <section class="summary">
      <h2>Professional Summary</h2>
      <p><?= nl2br(htmlspecialchars($resume['profile_details'])) ?></p>
    </section>

    <section>
      <h2>Education</h2>
      <ul>
        <li><strong>10th:</strong> <?= htmlspecialchars($resume['school_10']) ?> </li>
        <ul>
          <li>Percentage:   <?= htmlspecialchars($resume['marks_10']) ?>%</li>
        </ul>
        <li><strong>12th:</strong> <?= htmlspecialchars($resume['school_12']) ?> </li>
        <ul> 
          <li>Percentage:   <?= htmlspecialchars($resume['marks_12']) ?>% </li>
      </ul>

        <li><strong>Degree:</strong> <?= htmlspecialchars($resume['Degree']) ?> </li>
          <ul>
            <li> Collage:<?= htmlspecialchars($resume['Collage_name']) ?> </li> 
            <li>Pecentage:<?= htmlspecialchars($resume['Degree_per']) ?>%</li>
          </ul>
      </ul>
    </section>

    <div class="page-break"></div>

    <section>
      <h2>Projects</h2>
      <p><?= nl2br(htmlspecialchars($resume['Projects']))?></p>
    </section>

    <div class="page-break"></div>

    <section>
      <h2>Experience</h2>
      <p><?= nl2br(htmlspecialchars($resume['exp'])) ?></p>
    </section>
    <div class="page-break"></div>
    <section>
      <h2>Skills</h2>
      <p><?= htmlspecialchars($resume['skills']) ?></p>
    </section>

    <section>
      <h2>Additional Info</h2>
      <p><strong>Gender:</strong> <?= htmlspecialchars($resume['Gender']) ?> | <strong>Languages:</strong> <?= htmlspecialchars($resume['lang']) ?></p>
    </section>

    <section>
      <h2>Certificate</h2>
      <p><?= nl2br(htmlspecialchars($resume['Certificate']))?></p>

      <h2>Referance</h2>
      <p><?= nl2br(htmlspecialchars($resume['Referance']))?></p>
    </section>
  </div>

  <button id="downloadBtn" class="dwnBtn">Download as PDF</button>

  <script>
    document.getElementById("downloadBtn").addEventListener("click", function () {
      const element = document.getElementById("resumeContent");

      const opt = {
        margin:0,
        filename: 'resume.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true },
        jsPDF: { unit: 'pt', format: 'a4', orientation: 'portrait' },
        pagebreak: { mode: ['avoid-all'] }
      };

      html2pdf().set(opt).from(element).save();
    });
  </script>

</body>
</html>
