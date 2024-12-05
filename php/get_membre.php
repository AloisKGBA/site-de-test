<?php
header('Content-Type: application/json; charset=utf-8');
ob_clean(); // Supprime tout contenu précédemment envoyé

try {
    $pdo = new PDO("mysql:host=localhost;dbname=otawadev;charset=utf8", 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur de connexion à la base de données"]);
    exit;
}

// Vérifier les paramètres GET
if (isset($_GET['service'], $_GET['date_debut'], $_GET['date_fin'])) {
    $service = htmlspecialchars($_GET['service']);
    $date_debut = htmlspecialchars($_GET['date_debut']);
    $date_fin = htmlspecialchars($_GET['date_fin']);

    $query = "
        SELECT ID_membre, Nom, Prenom 
        FROM competence 
        WHERE Comp_service = :service
        AND ID_membre NOT IN (
            SELECT ID_Membre_Recense 
            FROM reservation 
            WHERE 
                (:date_debut BETWEEN Date_debut AND Date_fin OR 
                 :date_fin BETWEEN Date_debut AND Date_fin OR
                 Date_debut BETWEEN :date_debut AND :date_fin)
        )
    ";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':service', $service);
    $stmt->bindParam(':date_debut', $date_debut);
    $stmt->bindParam(':date_fin', $date_fin);
    $stmt->execute();

    $membres = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($membres);
    exit;
}

// Paramètres manquants
echo json_encode(["error" => "Paramètres manquants"]);
exit;
?>