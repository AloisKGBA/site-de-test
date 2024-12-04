<?php
// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=otawadev', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

// Récuperation info formulaire

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = isset($_POST['First_name']) ? trim($_POST['First_name']) : '';
    $nom = isset($_POST['Last_name']) ? trim($_POST['Last_name']) : '';
    $choix = isset($_POST['choix']) ? trim($_POST['choix']) : '';
    $Date_tel = "2023-09-15";
    $consent = isset($_POST['consent']) ? true : false;
    if (!empty($nom) && !empty($prenom) && !empty($choix)&& !empty($consent)) {
        // Récupère le lien du cv en fonction de celui choisi
        $sql = "SELECT Lien_CV FROM competence WHERE Prenom='$choix' ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Insert dans la base de donnée les infos de ceux qui ont téléchargé un cv
            $sql2 = "INSERT INTO formulaire_cv (Prenom, NOM, Date_tel, Nom_cv) VALUES (:prenom, :nom, :Date_tel, :choix)";
            $stmt = $pdo->prepare($sql2);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':Date_tel', $Date_tel);
            $stmt->bindParam(':choix', $choix);
            try {
                $stmt->execute();
            } catch (PDOException $e) {
            }

            // Permet de télécharger le cv 
            $lienCv = $result['lien_cv'];
            header('Location: download.php?file=' . urlencode($lienCv));
            exit();
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
