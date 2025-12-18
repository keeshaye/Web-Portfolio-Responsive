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
        echo "Merci de remplir correctement tous les champs.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Identifiants SMTP cachés pour sécurité
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'VOTRE_EMAIL';
        $mail->Password   = 'VOTRE_APP_PASSWORD';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom($email, $name);
        $mail->addAddress('VOTRE_EMAIL');

        $mail->isHTML(true);
        $mail->Subject = "Message depuis le portfolio";
        $mail->Body    = "Nom : $name<br>Email : $email<br>Message :<br>$message";

        $mail->send();
        echo "Message envoyé !";
    } catch (Exception $e) {
        echo "Erreur : {$mail->ErrorInfo}";
    }
}
?>
