<?php
header('Content-Type: application/json; charset=utf-8');
ob_clean(); // Supprimer les espaces ou contenu précédent
// Connexion à la base de données

try {
    $pdo = new PDO("mysql:host=localhost;dbname=otawadev;charset=utf8", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(["error" => "Erreur de connexion à la base de données"]));
}

// Vérifier si le service est passé en paramètre
if (isset($_GET['service'])) {
    $service = htmlspecialchars($_GET['service']); // Protéger contre les attaques XSS

    // Requête pour récupérer les membres correspondants
    $query = "SELECT ID_membre, Nom, Prenom FROM competence WHERE Comp_service = :service";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':service', $service, PDO::PARAM_STR);
    $stmt->execute();

    // Renvoyer les résultats en JSON
    $membres = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($membres);
    exit;
}

// Si aucun service n'est fourni, renvoyer une erreur
echo json_encode(["error" => "Service non spécifié"]);
exit;
?>