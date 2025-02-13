<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rallye_db";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}
echo "Connexion réussie";
?>
