<?php
// Inclure l'autoloader de Composer
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Instancier PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurer le serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com'; // Utilisez le serveur SMTP de Brevo (anciennement SendinBlue)
        $mail->SMTPAuth = true;
        $mail->Username = '80cf15001@smtp-brevo.com'; // Remplacez par votre e-mail Brevo
        $mail->Password = 'GCsFR2m6B9PLy1tI'; // Remplacez par votre clé API SMTP Brevo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurer l'expéditeur et les destinataires
        $mail->setFrom('epoudevigne@guardiaschool.fr', 'ottawa dev'); // Expéditeur
        $mail->addAddress('80cf15001@smtp-brevo.com', 'Brevo'); // Destinataire

        // Contenu de l'e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Nouveau message du formulaire de contact';
        $mail->Body = "
            <h2>Vous avez reçu un nouveau message :</h2>
            <p><strong>Nom :</strong> {$nom}</p>
            <p><strong>Email :</strong> {$email}</p>
            <p><strong>Message :</strong><br>{$message}</p>
        ";

        // Envoyer l'email
        $mail->send();
        echo "Message envoyé avec succès.";
    } catch (Exception $e) {
        echo "Une erreur s'est produite. Le message n'a pas été envoyé. Erreur : {$mail->ErrorInfo}";
    }
} else {
    echo "Méthode non autorisée.";
}
?>

