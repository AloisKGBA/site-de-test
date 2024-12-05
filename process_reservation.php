<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=otawadev","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

// Récupération des données du formulaire
$nom = htmlspecialchars(trim($_POST['nom']));
$prenom = htmlspecialchars(trim($_POST['prenom']));
$phone = htmlspecialchars(trim($_POST['phone']));
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : null;
$date_debut = $_POST['date_debut']; // Ajoutez une validation si nécessaire
$date_fin = $_POST['date_fin'];     // Ajoutez une validation si nécessaire
$service = htmlspecialchars(trim($_POST['service']));
$membre_dispo = htmlspecialchars(trim($_POST['membre_dispo'])); 

// Insertion dans la base de données
$sql = "INSERT INTO reservation (Nom_Client, Prenom_Client, Telephone, Mail, Date_debut, Date_fin, Service, ID_Membre_Recense) 
        VALUES (:nom, :prenom, :phone, :email, :date_debut, :date_fin, :service, :membre_dispo)";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':prenom', $prenom);
$stmt->bindParam(':phone', $phone);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':date_debut', $date_debut);
$stmt->bindParam(':date_fin', $date_fin);
$stmt->bindParam(':service', $service);
$stmt->bindParam(':membre_dispo', $membre_dispo);


if ($stmt->execute()) {
    echo "Réservation enregistrée avec succès!";
} else {
    echo "Erreur lors de l'enregistrement de la réservation.";
}
?>