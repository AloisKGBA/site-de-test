<?php
// Vérifier si le paramètre 'file' existe dans l'URL
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    // Le chemin complet de l'image sur le serveur (assurez-vous que le fichier existe dans ce répertoire)
    $filePath = 'images/portfolio/' . basename($file);  // Remplacez par le chemin réel
    // Vérifiez si le fichier existe sur le serveur
    if (file_exists($filePath)) {
        // Définir les en-têtes pour forcer le téléchargement
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Cache-Control: no-cache');
        header('Pragma: no-cache');

        // Lire le fichier et l'envoyer au navigateur
        readfile($filePath);
        // header('Location: pages/index.html'); // Remplacez 'formulaire.php' par l'URL de votre formulaire
        exit();
    } else {
        echo "Le fichier n'existe pas.";
    }
} else {
    echo "Aucun fichier spécifié pour le téléchargement.";
}
?>