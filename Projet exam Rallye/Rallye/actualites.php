<?php

// Activer le mode débogage 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

ini_set('log_errors', 1); // Active la journalisation des erreurs
ini_set('error_log', 'path/to/error.log'); // Définis un fichier de log


// Informations de connexion
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Projet-Rallye";

// Créer la connexion
$conn = @new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error . " (Code d'erreur : " . $conn->connect_errno . ")");
} else {
    // echo "Connexion réussie<br>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualités - Rallye Passion</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="logo">RallyePéÏ</div>
        <ul class="nav-links">
            <li><a href="index.php">Accueil</a></li>
            <li><a href="galerie.html">Galerie</a></li>
            <li><a href="actualite.php" class="active">Actualités</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

    <main>
        <article class="actualite-en-vedette">
            <img src="img St pierre\Actualité(6).jpg" alt="Image à la une">
            <div class="contenu">
                <!-- <span class="categorie">À la une</span> -->
                <h2>Les événements marquants de l'année 2024</h2>
            </div>
        </article>

        <!-- Compte à rebours -->
        <div id="compte-a-rebours">
            <p>Prochain événement dans <span id="temps"></span></p>
        </div>

        <!-- Inclure le fichier JavaScript -->
        <script src="script.js"></script>
        
        <section class="grille-des-actualites">
            <?php
            $sql = "SELECT title, content, author, publish_date, image_path FROM actualites";
            $result = $conn->query($sql);

            if (!$result) {
                die("Erreur dans la requête SQL : " . $conn->error);
            } else {
                // echo "Requête SQL réussie<br>";
            }

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<article class='carte-actualite'>";
                    echo "<img src='" . $row["image_path"] . "' alt='Image d'actualité'>"; // Utilise le chemin de l'image stocké
                    echo "<div class='contenu'>";
                    // echo "<span class='categorie'>Actualité</span>";
                    echo "<h3>" . $row["title"] . "</h3>";
                    echo "<p>" . $row["content"] . "</p>";
                    echo "<p><em>par " . $row["author"] . " le " . $row["publish_date"] . "</em></p>";
                    echo "</div>";
                    echo "</article>";
                }
            } else {
                echo "Aucune actualité trouvée.";
            }

            $conn->close();
            ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 RallyePéÏ. Tous droits réservés.</p>
    </footer>
</body>
</html>
