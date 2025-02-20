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

    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Projet-Rallye";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    // Préparation de la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO contact (name, email, message, contact_date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute() === TRUE) {
        // L'enregistrement a été inséré avec succès dans la base de données
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

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
