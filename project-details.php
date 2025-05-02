<?php
require_once 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("مشروع غير موجود.");
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();

if (!$project) die("المشروع غير موجود.");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($project["title"]) ?> - تفاصيل المشروع</title>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Tajawal', sans-serif;
      background-color: #f0f2f5;
      color: #2c3e50;
      margin: 0;
      padding: 0;
    }

    .project-header {
      background-color: #1a252f;
      color: white;
      padding: 2rem;
      text-align: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .project-header h1 {
      margin-bottom: 0.5rem;
    }

    .details-container {
      max-width: 900px;
      margin: auto;
      background-color: white;
      margin-top: 2rem;
      margin-bottom: 2rem;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0,0,0,0.05);
    }

    .project-image {
      width: 100%;
      max-height: 450px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 1rem;
    }

    .project-meta {
      color: #777;
      font-size: 0.95rem;
      margin-bottom: 1rem;
    }

    .project-description,
    .project-details {
      line-height: 1.8;
      margin-bottom: 1.5rem;
    }

    .download-link {
      display: inline-block;
      padding: 0.7rem 1.5rem;
      background-color: #1a252f;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      transition: background 0.3s;
    }

    .download-link:hover {
      background-color: #2c3e50;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 2rem;
      font-weight: bold;
    }

    .back-link a {
      color: #3498db;
      text-decoration: none;
    }

    .back-link a:hover {
      text-decoration: underline;
    }

    @media(max-width: 600px) {
      .details-container {
        padding: 1.2rem;
      }

      .download-link {
        width: 100%;
        text-align: center;
      }
    }
  </style>
</head>
<body>

  <div class="project-header">
    <h1><?= htmlspecialchars($project["title"]) ?></h1>
    <p>الفئة: <?= htmlspecialchars($project["category"]) ?></p>
  </div>

  <div class="details-container">
    <img src="images/<?= basename($project['image']) ?>" class="project-image">


    <div class="project-description">
      <h3>الوصف المختصر:</h3>
      <p><?= htmlspecialchars($project["description"]) ?></p>
    </div>

    <div class="project-details">
      <h3>تفاصيل المشروع:</h3>
      <p><?= nl2br(htmlspecialchars($project["details"])) ?></p>
    </div>

    <?php if ($project["pdf_file"]): ?>
      <a class="download-link" href="<?= htmlspecialchars($project["pdf_file"]) ?>" target="_blank">
        📥 تحميل الدراسة PDF
      </a>
    <?php endif; ?>

    <div class="back-link">
      <a href="projects.php">← الرجوع إلى المعرض</a>
    </div>
  </div>

</body>
</html>
