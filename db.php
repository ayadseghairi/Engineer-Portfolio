<?php
$conn = new mysqli("localhost", "root", "", "architecture_portfolio");

if ($conn->connect_error) {
  die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}
?>
