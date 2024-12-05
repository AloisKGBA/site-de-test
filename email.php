<?php
// Inclure l'autoloader généré par Composer
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Vérifier que le formulaire a été soumis via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Initialiser PHPMailer
    $mail = new PHPMailer(true); // IMPORTANT : Cette ligne doit être présente

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp-relay.brevo.com'; // Serveur SMTP de Brevo
        $mail->SMTPAuth = true;
        $mail->Username = '80cf15001@smtp-brevo.com'; // Votre e-mail Brevo
        $mail->Password = 'GCsFR2m6B9PLy1tI'; // Clé API SMTP Brevo
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Utilisation de STARTTLS
        $mail->Port = 587;

        // Destinataires
        $mail->setFrom('epoudevigne@guardiaschool.fr', 'ottawa dev');
        $mail->addAddress('80cf15001@smtp-brevo.com'); // Adresse où recevoir les messages

        // Contenu de l’e-mail
        $mail->isHTML(false);
        $mail->Subject = 'Nouveau message du formulaire de contact';
        $mail->Body = "Nom : $nom\nemail : $email\n\nMessage :\n$message";

        // Envoyer l’e-mail
        $mail->send();
        echo "Message envoyé avec succès.";
    } catch (Exception $e) {
        echo "Une erreur s'est produite : {$mail->ErrorInfo}";
    }
} else {
    echo "Méthode non autorisée.";
}
?>