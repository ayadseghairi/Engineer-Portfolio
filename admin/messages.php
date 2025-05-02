<?php
session_start();
require_once '../db.php';
if (!isset($_SESSION["admin_id"])) {
  header("Location: login.php");
  exit;
}

// حذف الرسالة
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM messages WHERE id = $id");
  header("Location: messages.php");
  exit;
}

// جلب الرسائل
$messages = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>رسائل التواصل</title>
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
    }
    h2 {
      text-align: center;
      margin-bottom: 2rem;
    }
    table {
      width: 100%;
      background: white;
      border-collapse: collapse;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    th, td {
      padding: 1rem;
      border: 1px solid #ccc;
      text-align: right;
      vertical-align: top;
    }
    th {
      background-color: #1a252f;
      color: white;
    }
    .btn {
      padding: 0.4rem 0.8rem;
      border-radius: 6px;
      text-decoration: none;
      font-size: 0.9rem;
      margin-left: 0.3rem;
    }
    .delete {
      background-color: #e74c3c;
      color: white;
    }
    .reply {
      background-color: #3498db;
      color: white;
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
  <h2>📬 الرسائل الواردة</h2>
  <table>
    <thead>
      <tr>
        <th>الاسم</th>
        <th>البريد</th>
        <th>الموضوع</th>
        <th>الرسالة</th>
        <th>تاريخ الإرسال</th>
        <th>الإجراء</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($msg = $messages->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($msg['name']) ?></td>
          <td><?= htmlspecialchars($msg['email']) ?></td>
          <td><?= htmlspecialchars($msg['subject']) ?></td>
          <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
          <td><?= $msg['created_at'] ?></td>
          <td>
            <a class="btn reply" href="mailto:<?= htmlspecialchars($msg['email']) ?>?subject=رد على: <?= rawurlencode($msg['subject']) ?>">رد</a>
            <a class="btn delete" href="?delete=<?= $msg['id'] ?>" onclick="return confirm('هل أنت متأكد من حذف الرسالة؟')">حذف</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>

</body>
</html>
