<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST["name"]);
    $email   = htmlspecialchars($_POST["email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    $to      = "youremail@example.com"; // غيره إلى إيميلك
    $headers = "From: $email";
    $fullMsg = "الاسم: $name\nالبريد: $email\nالموضوع: $subject\n\nالرسالة:\n$message";

    if (mail($to, $subject, $fullMsg, $headers)) {
        echo "تم إرسال الرسالة بنجاح!";
    } else {
        echo "حدث خطأ أثناء الإرسال.";
    }
}
?>
