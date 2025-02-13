<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/wamp64/www/Projet-Rallye/Projet exam Rallye/Rallye/php/phpmailler/PHPMailer-master/src/Exception.php';
require 'C:/wamp64/www/Projet-Rallye/Projet exam Rallye/Rallye/php/phpmailler/PHPMailer-master/src/PHPMailer.php';
require 'C:/wamp64/www/Projet-Rallye/Projet exam Rallye/Rallye/php/phpmailler/PHPMailer-master/src/SMTP.php';

// Définir les variables d'environnement au début du script
putenv('EMAIL_USERNAME=rebeccasoan1305@gmail.com');
putenv('EMAIL_PASSWORD=dfnj lmkk fhes vcsj'); // Utilisez le mot de passe d'application généré

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    // Validation supplémentaire des données
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse email invalide.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = getenv('EMAIL_USERNAME'); 
        $mail->Password = getenv('EMAIL_PASSWORD'); 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Activer le débogage SMTP
        $mail->SMTPDebug = 0; // Désactiver le débogage SMTP
        $mail->Debugoutput = 'html';

        // Destinataires
        $mail->setFrom($email, $name);
        $mail->addAddress('vivierayan@gmail.com');

        // Contenu de l'e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Nouveau message de contact de ' . $name;
        $mail->Body    = '<p>Nom : ' . $name . '</p><p>Email : ' . $email . '</p><p>Message : ' . $message . '</p>';
        $mail->AltBody = 'Nom : ' . $name . '\nEmail : ' . $email . '\nMessage : ' . $message;

        // Confirmation avec redirection
        $mail->send();
        header('Location: confirmation.html');
        exit();
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
        error_log("Erreur d'envoi de mail : {$mail->ErrorInfo}");
    }
} else {
    echo "Méthode de requête invalide.";
}
?>
