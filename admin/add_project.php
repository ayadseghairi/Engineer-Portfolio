<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title       = $_POST["title"];
    $description = $_POST["description"];
    $category    = $_POST["category"];
    $details     = $_POST["details"];

    $imagePath = "";
    $pdfPath   = "";

    // رفع الصورة
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $imageDir   = "../images/";
        $imageName  = time() . "_" . basename($_FILES["image"]["name"]);
        $imageFile  = $imageDir . $imageName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $imageFile)) {
            $imagePath = "images/" . $imageName;
        } else {
            die("❌ فشل في رفع الصورة.");
        }
    } else {
        die("❌ لم يتم اختيار صورة.");
    }

    // رفع PDF (اختياري)
    if (isset($_FILES["pdf"]) && $_FILES["pdf"]["error"] == 0) {
        $pdfDir   = "../files/";
        $pdfName  = time() . "_" . basename($_FILES["pdf"]["name"]);
        $pdfFile  = $pdfDir . $pdfName;

        if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $pdfFile)) {
            $pdfPath = "files/" . $pdfName;
        }
    }

    // تسجيل المشروع
    $stmt = $conn->prepare("INSERT INTO projects (title, description, image, category, details, pdf_file) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $description, $imagePath, $category, $details, $pdfPath);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>
