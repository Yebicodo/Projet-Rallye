
<?php include 'connex_bdd.php'; ?>
<?php include 'header.php'; ?>

<main>
    <article class="actualite-en-vedette">
        <img src="img St pierre\Actualité(6).jpg" alt="Image à la une">
        <div class="contenu">
    </article>

    <!-- Compte à rebours -->
    <div id="compte-a-rebours">
        <p>Prochain événement dans <span id="temps"></span></p>
    </div>

    <!-- Inclure le fichier JavaScript -->
    <script src="script.js"></script>
    
    <section class="grille-des-actualites">
        <?php
        // Préparer la requête SQL pour sélectionner les colonnes nécessaires de la table actualites et exécute la requête.
        $stmt = $conn->prepare("SELECT title, content, author, publish_date, image_path FROM actualites");
        $stmt->execute();
        $result = $stmt->get_result();

        // Vérifie si la requête a échoué et affiche un message d'erreur en cas d'échec.
        if (!$result) {
            die("Erreur dans la requête SQL : " . $conn->error);
        } else {
            // echo "Requête SQL réussie<br>";
        }

        // Si des résultats sont trouvés, il crée des articles d'actualités en HTML pour chaque enregistrement récupéré et les affiche.
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<article class='carte-actualite'>";
                echo "<img src='" . htmlspecialchars($row["image_path"]) . "' alt='Image d'actualité'>"; // Utilise le chemin de l'image stocké
                echo "<div class='contenu'>";
                echo "<h3>" . htmlspecialchars($row["title"]) . "</h3>";
                echo "<p>" . htmlspecialchars($row["content"]) . "</p>";
                echo "<p><em>par " . htmlspecialchars($row["author"]) . " le " . htmlspecialchars($row["publish_date"]) . "</em></p>";
                echo "</div>";
                echo "</article>";
            }
        } else {
            echo "Aucune actualité trouvée.";
        }
        // Ferme la requête et la connexion à la base de données.
        $stmt->close();
        $conn->close();
        ?>
    </section>
</main>

<?php include 'footer.php'; ?>
