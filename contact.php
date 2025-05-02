<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name    = htmlspecialchars($_POST["name"]);
  $email   = htmlspecialchars($_POST["email"]);
  $subject = htmlspecialchars($_POST["subject"]);
  $message = htmlspecialchars($_POST["message"]);

  $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $name, $email, $subject, $message);
  $stmt->execute();

  $success = true;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تواصل معنا - مكتب الدراسات</title>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    .contact-container {
      max-width: 700px;
      margin: 2rem auto;
      background-color: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
    }

    form label {
      display: block;
      margin-top: 1rem;
      font-weight: bold;
    }

    form input, form textarea {
      width: 100%;
      padding: 0.8rem;
      margin-top: 0.3rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }

    form button {
      margin-top: 1.5rem;
      width: 100%;
      padding: 0.8rem;
      background-color: #1a252f;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
    }

    form button:hover {
      background-color: #2c3e50;
    }

    .success-message {
      background-color: #d4edda;
      color: #155724;
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 1rem;
      text-align: center;
    }

    @media(max-width: 600px) {
      .contact-container {
        padding: 1.2rem;
      }
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

<section class="contact-container">
  <h2 style="text-align: center;">📬 تواصل معنا</h2>

  <?php if (isset($success)): ?>
    <div class="success-message">✔️ تم إرسال الرسالة بنجاح.</div>
  <?php endif; ?>

  <form method="POST" action="contact.php">
    <label for="name">الاسم الكامل:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">البريد الإلكتروني:</label>
    <input type="email" id="email" name="email" required>

    <label for="subject">الموضوع:</label>
    <input type="text" id="subject" name="subject">

    <label for="message">الرسالة:</label>
    <textarea id="message" name="message" rows="6" required></textarea>

    <button type="submit">📨 إرسال</button>
  </form>
</section>

<footer>
  <p>© 2025 مكتب الدراسات المعمارية - جميع الحقوق محفوظة</p>
</footer>

</body>
</html>
