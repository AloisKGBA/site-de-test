<!-- <?php

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
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message_ut = isset($_POST['message']) ? trim($_POST['message']) : '';

    if (!empty($nom) && !empty($email) && !empty($message_ut)) {
        $sql = "INSERT INTO formulaire (nom, Adresse_mail, message) VALUES (:nom, :email, :message_ut)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message_ut', $message_ut);

        try {
            $stmt->execute();
            echo "Données insérées avec succès !";
        } catch (PDOException $e) {
            echo "<p style='color: red;'>Erreur lors de l'insertion : " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Veuillez remplir tous les champs du formulaire.</p>";
    }
} else {
    echo "<p style='color: red;'>Le formulaire n'a pas été soumis correctement.</p>";
}
?> -->