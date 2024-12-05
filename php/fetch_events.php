<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=otawadev", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de connexion : ' . $e->getMessage()]);
    exit;
}

// Récupérer toutes les réservations
$sql = "
    SELECT 
        c.Nom, 
        c.Prenom, 
        r.Nom_Client, 
        r.Prenom_Client, 
        r.Service, 
        r.Date_debut, 
        r.Date_fin
    FROM reservation r
    JOIN competence c ON r.ID_Membre_Recense = c.ID_Membre
";
$stmt = $pdo->query($sql);

// Préparer les données pour FullCalendar
$events = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $date_fin_corrigee = date('Y-m-d', strtotime($row['Date_fin'] . ' +1 day'));
    $events[] = [
        'title' => $row['Nom_Client'] . ' ' . $row['Prenom_Client'] . ' - ' . $row['Service'],
        'start' => $row['Date_debut'],
        'end' => $date_fin_corrigee,
        'description' => 'Avec : ' . $row['Nom'] . ' ' . $row['Prenom'],
    ];
}

// Renvoyer les données au format JSON
header('Content-Type: application/json');
echo json_encode($events);