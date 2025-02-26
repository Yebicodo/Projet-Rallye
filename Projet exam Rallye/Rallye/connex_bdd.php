<?php

// Activer le mode débogage permettent d'afficher les erreurs et les avertissements PHP pour le débogage.
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// Journalisation des erreurs : Ces lignes activent la journalisation des erreurs et définissent le chemin du fichier où les erreurs seront enregistrées.
ini_set('log_errors', 1); // Active la journalisation des erreurs
ini_set('error_log', 'path/to/error.log'); // Définis un fichier de log


// Paramètres de connexion site en ligne
$serveur = "heure.o2switch.net";
$utilisateur = "sc6anda4429_vivie"; // Nom d'utilisateur MySQL
$mot_de_passe = "Jetaimerayan130527995"; // Mot de passe MySQL
$base_de_donnees = "";     // Nom de la base de données



// Informations de connexion localhost
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "Projet-Rallye";



// Créer la connexion Ces variables contiennent les informations nécessaires pour se connecter à la base de données MySQL connection local.
// $conn = new mysqli($servername, $username, $password, $dbname);

// Créer la connexion en ligne en local
// $conn = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Créer la connexion en ligne
$conn = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);


// Vérifier la connexion Ce bloc de code vérifie si la connexion à la base de données a échoué et, si c'est le cas, affiche un message d'erreur et met fin au script.
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error . " (Code d'erreur : " . $conn->connect_errno . ")");
} else {
    // echo "Connexion réussie<br>";
}

?>