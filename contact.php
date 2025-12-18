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
        // Paramètres SMTP (exemple avec Gmail)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'keeshayesewduth100@gmail.com';
        $mail->Password   = 'waaq berc kzwu sdwx';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Destinataire
        $mail->setFrom($email, $name);
        $mail->addAddress('keeshayesewduth100@gmail.com', 'Keeshaye');

        // Contenu du mail
        $mail->isHTML(true);
        $mail->Subject = "Message depuis le portfolio";
        $mail->Body    = "Nom : $name<br>Email : $email<br>Message :<br>$message";

        $mail->send();
        echo "Message envoyé avec succès !";
    } catch (Exception $e) {
        echo "Erreur lors de l'envoi : {$mail->ErrorInfo}";
    }
}
?>
