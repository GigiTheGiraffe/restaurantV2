<?php

try {
    $conn = new PDO("mysql:host=" . getenv('DB_SERVERNAME_ACCESS') . ";dbname=" . getenv('DB_NAME_ACCESS'), getenv('DB_USERNAME_ACCESS'), getenv('DB_PASSWORD_ACCESS'));
    // Ajout des erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Préparation de la requête d'insertion
    $data = [
        ':email' => $email,
        ':prenom' => $firstname,
        ':nom' => $lastname,
        ':objet' => $selectMessage,
        ':message' => $message
    ];
    // Preparation de la requete
    $stmt = $conn->prepare("INSERT INTO messages (email, prenom, nom, objet, message) VALUES (:email, :prenom, :nom, :objet, :message)");

    // Bind parameters
    foreach ($data as $param => $value) {
        $stmt->bindValue($param, $value);
    }
    // Exécution de la requête
    $stmt->execute();
} catch (PDOException $e) {
    //echo "Connection failed: " . $e->getMessage();
    $messageErreur = "Connection impossible à la base de donnée, pourriez-vous contacter le propriétaire s'il vous plait?";
    exit;
}
$conn = null;
