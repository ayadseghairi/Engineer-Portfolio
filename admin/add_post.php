<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION["admin_id"])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $title = $_POST["title"];
  $content = $_POST["content"];

  $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
  $stmt->bind_param("ss", $title, $content);
  $stmt->execute();

  header("Location: dashboard.php");
  exit;
}
?>
