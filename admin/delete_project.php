<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);

    // حذف الصورة من السيرفر (اختياري)
    $res = $conn->query("SELECT image FROM projects WHERE id = $id");
    $row = $res->fetch_assoc();
    if ($row && file_exists("../" . $row["image"])) {
        unlink("../" . $row["image"]);
    }

    // حذف المشروع من القاعدة
    $conn->query("DELETE FROM projects WHERE id = $id");
}

header("Location: dashboard.php");
exit;
?>
