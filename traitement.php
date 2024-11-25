<?php

//Connection à la base de donnée de Otawa
// try {
//     $pdo = new PDO('mysql:host=nom_hôte;dbname=otawadev', 'utilisateur', 'mot_de_passe');
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Erreur de connexion : " . $e->getMessage();
//     exit();
// }


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $nom = isset($_GET['nom']) ? htmlspecialchars(trim($_GET['nom'])) : '';
    $email = isset($_GET['email']) ? htmlspecialchars(trim($_GET['email'])) : '';
    $message = isset($_GET['message']) ? htmlspecialchars(trim($_GET['message'])) : '';

    if (!empty($nom) && !empty($email) && !empty($message)) {
        echo "<h1>Données reçues :</h1>";
        echo "<p><strong>Nom :</strong> $nom</p>";
        echo "<p><strong>Email :</strong> $email</p>";
        echo "<p><strong>Message :</strong> $message</p>";
    } else {
        echo "<p style='color: red;'>Veuillez remplir tous les champs du formulaire.</p>";
    }
} else {
    echo "<p style='color: red;'>Le formulaire n'a pas été soumis correctement.</p>";
}
?>