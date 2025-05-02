<?php
require_once 'db.php';
$projects = $conn->query("SELECT * FROM projects ORDER BY created_at DESC LIMIT 6");
$posts = $conn->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>الرئيسية - مكتب الدراسات المعمارية</title>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Tajawal', sans-serif;
      margin: 0;
      padding: 0;
      background: #f0f2f5;
      color: #2c3e50;
    }
    

    
    .hero {
      text-align: center;
      padding: 3rem 1rem;
      background: #ffffff;
    }
    .hero h2 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }
    .projects-preview, .posts-preview {
      max-width: 1000px;
      margin: auto;
      padding: 2rem;
    }
    .project-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 1.5rem;
    }
    .project-card {
      background-color: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 0 12px rgba(0,0,0,0.06);
      padding: 1rem;
    }
    .project-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
    }
    .project-card h3 {
      margin-top: 0.8rem;
    }
    .project-card p {
      font-size: 0.95rem;
      color: #666;
    }
    .project-card a {
      display: inline-block;
      margin-top: 0.8rem;
      color: #1a252f;
      font-weight: bold;
      text-decoration: none;
    }
    .project-card a:hover {
      text-decoration: underline;
    }
    .post-box {
      background-color: #fff;
      padding: 1.5rem;
      margin-bottom: 1rem;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .post-box h3 {
      margin-top: 0;
    }
    .post-box p {
      line-height: 1.6;
      margin: 0.5rem 0;
    }
    .post-box small {
      color: gray;
    }
    footer {
      text-align: center;
      padding: 1.5rem;
      background-color: #1a252f;
      color: white;
      margin-top: 3rem;
    }
    .project-card {
      transition: transform 0.3s ease;
    }
    .project-card:hover {
      transform: scale(1.03);
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

<section class="hero">
  <h2>مرحبا بكم في مكتبنا</h2>
  <p>نقدم خدمات التصميم المعماري، الداخلي، والمتابعة الهندسية باحترافية عالية</p>
</section>

<section class="posts-preview">
  <h2>📢 آخر الإعلانات</h2>
  <?php while ($post = $posts->fetch_assoc()): ?>
    <div class="post-box">
      <h3><?= htmlspecialchars($post['title']) ?></h3>
      <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
      <small>📅 <?= $post['created_at'] ?></small>
    </div>
  <?php endwhile; ?>
</section>

<section class="projects-preview">
  <h2>أحدث المشاريع</h2>
  <div class="project-grid">
    <?php while ($p = $projects->fetch_assoc()): ?>
      <div class="project-card">
        <img src="<?= htmlspecialchars($p['image']) ?>" alt="صورة المشروع">
        <h3><?= htmlspecialchars($p['title']) ?></h3>
        <p><?= htmlspecialchars($p['description']) ?></p>
        <a href="project-details.php?id=<?= $p['id'] ?>">عرض التفاصيل</a>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<footer>
  <p>© 2025 مكتب الدراسات المعمارية - جميع الحقوق محفوظة</p>
</footer>

</body>
</html>
