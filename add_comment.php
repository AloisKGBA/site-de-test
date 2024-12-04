<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=otawadev', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    $prenom = isset($_POST['firstName']) ? trim ($_POST['firstName']) : '';
    $nom = isset($_POST['lastName']) ? trim ($_POST['lastName']) : '';
    $subject = isset($_POST['subject']) ? trim ($_POST['subject']) : '';
    $email = isset($_POST['email']) ? trim ($_POST['email']) : '';
    $comment = isset($_POST['comment']) ? trim ($_POST['comment']) : '';
    $profilePic = isset($_POST['profilePic']) ? trim ($_POST['profilePic']) : '';

    if (empty($prenom) || empty($nom) || empty($email)) {
        echo "Les champs prénom, nom et email sont obligatoires.";
        exit();
    }

    $profilePic = null;
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
        $profilePic = 'uploads/' . basename($_FILES['profilePic']['name']);
        move_uploaded_file($_FILES['profilePic']['tmp_name'], $profilePic);
    }

    $sql = "INSERT INTO ma_table (firstName, lastName, subject, email, comment, profilePic) 
            VALUES (:firstName, :lastName, :subject, :email, :comment, :profilePic)";
    $stmt = $pdo->prepare($sql);
        
        // Liaison des paramètres
    $stmt->bindValue(':firstName', $prenom, PDO::PARAM_STR);
    $stmt->bindValue(':lastName', $nom, PDO::PARAM_STR);
    $stmt->bindValue(':subject', $subject, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':profilePic', $profilePic, PDO::PARAM_STR);
        
    try {
        // Exécution de la requête
        $stmt->execute();

        echo "Les données ont été insérées avec succès !";
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
    }

}

?>


