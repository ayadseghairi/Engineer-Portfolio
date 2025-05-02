<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit;
}

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $conn->query("DELETE FROM posts WHERE id = $id");
}

header("Location: dashboard.php");
exit;
?>
