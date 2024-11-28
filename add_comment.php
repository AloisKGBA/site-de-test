<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=otawadev', 'root', 'root');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit();
}
header("Content-Type: application/json");
$host = 'localhost'; 
$user = 'root'; 
$password = ''; 
$dbname = 'commentaires';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed: " . $conn->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);

$firstName = $conn->real_escape_string($data['firstName']);
$lastName = $conn->real_escape_string($data['lastName']);
$email = $conn->real_escape_string($data['email']);
$subject = $conn->real_escape_string($data['subject']);
$comment = $conn->real_escape_string($data['comment']);
$profilePic = $conn->real_escape_string($data['profilePic']);

$sql = "INSERT INTO comments (firstName, lastName, email, subject, comment, profilePic) 
        VALUES ('$firstName', '$lastName', '$email', '$subject', '$comment', '$profilePic')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "id" => $conn->insert_id]);
} else {
    echo json_encode(["error" => "Error: " . $conn->error]);
}

$conn->close();
?>
