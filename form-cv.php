<?php
// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=otawadev', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

// Récuperation info formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = isset($_POST['First_name']) ? trim($_POST['First_name']) : '';
    $nom = isset($_POST['Last_name']) ? trim($_POST['Last_name']) : '';
    $choix = isset($_POST['choix']) ? $_POST['choix'] : '';
    $consent = isset($_POST['consent']) ? true : false;
    echo "le choix est :". $choix;
    if (!empty($nom) && !empty($prenom) && !empty($choix)&& !empty($consent)) {
        $sql = "SELECT lien_cv FROM cv_membre";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $sql2 = "INSERT INTO formulaire_cv (Prenom, Nom, Nom_cv) VALUES (:prenom, :nom, :choix)";
            $stmt = $pdo->prepare($sql2);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':choix', $choix);
            try {
                $stmt->execute();
                echo "Données insérées avec succès !";
            } catch (PDOException $e) {
                echo "<p style='color: red;'>Erreur lors de l'insertion : " . $e->getMessage() . "</p>";
            }
            $lienCv = $result['lien_cv'];
            echo "Lien récupéré : " . $lienCv;
            echo '<br><a href="download.php?file=' . urlencode($lienCv) . '">Télécharger le CV</a>';
        } else {
            echo "Aucun CV trouvé.";
        }
    } else {
        echo "<p style='color: red;'>Veuillez remplir tous les champs du formulaire.</p>";
    }
} 
else {
    echo "<p style='color: red;'>Le formulaire n'a pas été soumis correctement.</p>";
}
?>

<!-- echo '<a href="' . $data['chemin_pdf']. '" target="_blank">Fichier ' . PDF . '</a><br>'; -->
