<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST['message']);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please fill all fields correctly.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP credentials are hidden for security
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'YOUR_EMAIL';
        $mail->Password   = 'YOUR_APP_PASSWORD';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('YOUR_EMAIL');

        $mail->isHTML(true);
        $mail->Subject = "Message from portfolio";
        $mail->Body    = "Name: $name<br>Email: $email<br>Message:<br>$message";

        $mail->send();
        echo "Message sent!";
    } catch (Exception $e) {
        echo "Mail error: {$mail->ErrorInfo}";
    }
}
?>
