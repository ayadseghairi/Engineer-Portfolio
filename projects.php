<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>المشاريع - مكتب الدراسات</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header>
    <h1>مشاريعنا</h1>
    <nav>
      <ul>
        <li><a href="index.php">الرئيسية</a></li>
        <li><a href="projects.php">المشاريع</a></li>
        <li><a href="about.php">من نحن</a></li>
        <li><a href="contact.php">تواصل معنا</a></li>
      </ul>
    </nav>
  </header>

  <section class="projects">
    <h2>بعض من إنجازاتنا</h2>
    <div class="project-grid">
      <?php
      $result = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
      while ($project = $result->fetch_assoc()):
      ?>
        <div class="project-card">
        <img src="<?= htmlspecialchars($project['image']) ?>" alt="صورة المشروع">
          <h3><?= htmlspecialchars($project['title']) ?></h3>
          <p><?= htmlspecialchars($project['description']) ?></p>
          <a href="project-details.php?id=<?= $project['id'] ?>">المزيد</a>
          <!-- ممكن تضيف زر تفاصيل هنا -->
        </div>
      <?php endwhile; ?>
    </div>
  </section>

  <footer>
    <p>© 2025 مكتب الدراسات المعمارية - جميع الحقوق محفوظة</p>
  </footer>

</body>
</html>
