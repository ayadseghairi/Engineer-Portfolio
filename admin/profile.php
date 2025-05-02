<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION["admin_id"];
$stmt = $conn->prepare("SELECT * FROM admin WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email     = $_POST["email"];
    $bio       = $_POST["bio"];
    $facebook  = $_POST["facebook"];
    $linkedin  = $_POST["linkedin"];
    $behance   = $_POST["behance"];

    $avatarPath = $user["avatar"];
    if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
        $targetDir = "../images/";
        $fileName = basename($_FILES["avatar"]["name"]);
        $targetFile = $targetDir . time() . "_" . $fileName;
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
            $avatarPath = str_replace("../", "", $targetFile);
        }
    }

    $update = $conn->prepare("UPDATE admin SET full_name=?, email=?, bio=?, avatar=?, facebook=?, linkedin=?, behance=? WHERE id=?");
    $update->bind_param("sssssssi", $full_name, $email, $bio, $avatarPath, $facebook, $linkedin, $behance, $id);
    $update->execute();

    if (!empty($_POST["new_password"])) {
        $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
        $updatePass = $conn->prepare("UPDATE admin SET password=? WHERE id=?");
        $updatePass->bind_param("si", $new_password, $id);
        $updatePass->execute();
    }

    header("Location: profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تعديل البروفايل</title>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <style>
    body {
      font-family: 'Tajawal', sans-serif;
      background-color: #f0f2f5;
      color: #2c3e50;
      margin: 0;
      padding: 0;
    }
    
    .container {
      max-width: 700px;
      margin: auto;
      margin-top: 2rem;
      background-color: white;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    }
    .avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      margin: auto;
      display: block;
      border: 2px solid #ccc;
    }
    form label {
      display: block;
      margin-top: 1rem;
      font-weight: bold;
    }
    form input, form textarea {
      width: 100%;
      padding: 0.7rem;
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
  <h2 style="text-align:center">تعديل البروفايل</h2>
  <img src="../<?= htmlspecialchars($user['avatar']) ?>" class="avatar" alt="الصورة الشخصية">

  <form method="POST" enctype="multipart/form-data">
    <label>الاسم الكامل:</label>
    <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>">

    <label>البريد الإلكتروني:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">

    <label>نبذة تعريفية:</label>
    <textarea name="bio" rows="4"><?= htmlspecialchars($user['bio']) ?></textarea>

    <label>رابط Facebook:</label>
    <input type="url" name="facebook" value="<?= htmlspecialchars($user['facebook']) ?>">

    <label>رابط LinkedIn:</label>
    <input type="url" name="linkedin" value="<?= htmlspecialchars($user['linkedin']) ?>">

    <label>رابط Behance:</label>
    <input type="url" name="behance" value="<?= htmlspecialchars($user['behance']) ?>">

    <label>الصورة الشخصية (اختياري):</label>
    <input type="file" name="avatar" accept="image/*">

    <label>كلمة مرور جديدة (اختياري):</label>
    <input type="password" name="new_password" placeholder="أدخل كلمة سر جديدة">

    <button type="submit">💾 حفظ التعديلات</button>
  </form>
</div>

</body>
</html>
