<?php
require_once 'db.php';
session_start();

// جلب بيانات الأدمن
$stmt = $conn->prepare("SELECT * FROM admin LIMIT 1");
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>من نحن - مكتب الدراسات</title>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Tajawal', sans-serif;
      background-color: #f0f2f5;
      color: #2c3e50;
      margin: 0;
      padding: 0;
    }
    
    .about-container {
      max-width: 900px;
      margin: auto;
      background-color: white;
      padding: 2rem;
      margin-top: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0,0,0,0.05);
      text-align: center;
    }
    .avatar {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #ccc;
      margin-bottom: 1rem;
    }
    h2 {
      color: #1a252f;
      margin-bottom: 0.3rem;
    }
    .subtitle {
      color: #777;
      margin-bottom: 1.5rem;
    }
    .bio {
      line-height: 1.8;
      margin-bottom: 2rem;
    }
    .social a {
      display: inline-block;
      margin: 0.5rem;
      padding: 0.5rem 1rem;
      background-color: #f1f1f1;
      border-radius: 8px;
      color: #1a252f;
      text-decoration: none;
      font-weight: bold;
    }
    .social a:hover {
      background-color: #e1e1e1;
    }
    footer {
      text-align: center;
      padding: 1.5rem;
      background-color: #1a252f;
      color: white;
      margin-top: 3rem;
    }
  </style>
</head>
<body>

<header>
  <h1>مكتب الدراسات المعمارية</h1>
  <nav>
    <ul>
      <li><a href="index.php">الرئيسية</a></li>
      <li><a href="projects.php">المشاريع</a></li>
      <li><a href="about.php">من نحن</a></li>
      <li><a href="contact.php">تواصل معنا</a></li>
    </ul>
  </nav>
</header>

<div class="about-container">
  <?php if (!empty($admin['avatar'])): ?>
    <img src="<?= htmlspecialchars($admin['avatar']) ?>" alt="الصورة الشخصية" class="avatar">
  <?php else: ?>
    <img src="images/avatar-placeholder.png" alt="لا توجد صورة" class="avatar">
  <?php endif; ?>

  <h2><?= htmlspecialchars($admin['full_name']) ?></h2>
  <p class="subtitle">مدير المكتب المعماري</p>

  <p class="bio">
    <?= nl2br(htmlspecialchars($admin['bio'])) ?>
  </p>

  <p><strong>📧 البريد الإلكتروني:</strong> <?= htmlspecialchars($admin['email']) ?></p>

  <div class="social">
    <h3>تابعني على:</h3>
    <?php if (!empty($admin['facebook'])): ?>
      <a href="<?= htmlspecialchars($admin['facebook']) ?>" target="_blank">📘 Facebook</a>
    <?php endif; ?>
    <?php if (!empty($admin['linkedin'])): ?>
      <a href="<?= htmlspecialchars($admin['linkedin']) ?>" target="_blank">💼 LinkedIn</a>
    <?php endif; ?>
    <?php if (!empty($admin['behance'])): ?>
      <a href="<?= htmlspecialchars($admin['behance']) ?>" target="_blank">🎨 Behance</a>
    <?php endif; ?>
  </div>
</div>

<footer>
  © 2025 مكتب الدراسات المعمارية - جميع الحقوق محفوظة
</footer>

</body>
</html>
