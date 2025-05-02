<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

require_once '../db.php';

$projects = $conn->query("SELECT * FROM projects ORDER BY created_at DESC");
$posts = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>لوحة التحكم - الأدمن</title>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <style>
    body {
      font-family: 'Tajawal', sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 0;
      color: #333;
    }

    

    .container {
      padding: 2rem;
      max-width: 1000px;
      margin: auto;
    }

    .section {
      background-color: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0,0,0,0.05);
      margin-bottom: 2rem;
    }

    form input, form textarea, form button {
      display: block;
      width: 100%;
      padding: 0.7rem;
      margin-top: 0.5rem;
      margin-bottom: 1rem;
      font-size: 1rem;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    form button {
      background-color: #1a252f;
      color: white;
      border: none;
      transition: background 0.3s ease;
    }

    form button:hover {
      background-color: #2c3e50;
    }




    a.btn-secondary {
      background-color: #3498db;
      color: white;
      text-decoration: none;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      display: inline-block;
      font-weight: bold;
    }

    a.btn-secondary:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>

<header>
  <h1>لوحة تحكم الأدمن</h1>
  <nav>
    <ul>
      <li><a href="dashboard.php">الرئيسية</a></li>
      <li><a href="messages.php">الرسائل</a></li>
      <li><a href="profile.php">بروفايلي</a></li>
      <li><a href="logout.php">خروج</a></li>
    </ul>
  </nav>
</header>

<div class="container">
  <div class="section">
    <h3>📝 إضافة منشور جديد:</h3>
    <form method="POST" action="add_post.php">
      <input type="text" name="title" placeholder="عنوان المنشور" required>
      <textarea name="content" placeholder="محتوى المنشور" rows="4" required></textarea>
      <button type="submit">نشر</button>
    </form>
  </div>

  <div class="section">
    <h3>📚 المنشورات:</h3>
    <ul>
      <?php while ($post = $posts->fetch_assoc()): ?>
        <li>
          <?= htmlspecialchars($post['title']) ?> - <?= date('Y-m-d', strtotime($post['created_at'])) ?>
          <a href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('هل أنت متأكد من حذف المنشور؟')" style="color:red; margin-right:1rem;">[حذف]</a>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>

  <div class="section">
    <h3>➕ إضافة مشروع جديد:</h3>
    <form method="POST" action="add_project.php" enctype="multipart/form-data">
      <input type="text" name="title" placeholder="عنوان المشروع" required>
      <textarea name="description" placeholder="الوصف المختصر" required></textarea>
      <input type="text" name="category" placeholder="الفئة (سكني / صحي / إداري ...)" required>
      <textarea name="details" placeholder="تفاصيل المشروع المطولة" rows="4"></textarea>
      <input type="file" name="image" accept="image/*" required>
      <input type="file" name="pdf" accept="application/pdf">
      <button type="submit">إضافة</button>
    </form>
  </div>

  <div class="section">
    <h3>📁 قائمة المشاريع:</h3>
    <ul>
      <?php while ($row = $projects->fetch_assoc()): ?>
        <li>
          <?= htmlspecialchars($row["title"]) ?>
          <a href="delete_project.php?id=<?= $row["id"] ?>">[حذف]</a>
        </li>
      <?php endwhile; ?>
    </ul>
  </div>

  <div class="section">
    <h3>📬 الرسائل الواردة</h3>
    <a href="messages.php" class="btn-secondary">عرض جميع الرسائل</a>
  </div>
</div>

</body>
</html>
