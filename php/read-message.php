<?php
// Chargement du mdp et username

try {
    $conn = new PDO("mysql:host=" . getenv('DB_SERVERNAME_DELETE') . ";dbname=" . getenv('DB_NAME_DELETE'), getenv('DB_USERNAME_DELETE'), getenv('DB_PASSWORD_DELETE'));
    // Ajout des erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Préparation de la requête de fetch
    $stmt = $conn->prepare("SELECT * FROM messages ORDER BY id");
    // Set en mode fetch pour aller prendre les donnees
    $stmt->execute();
    $resultMessage = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Exécution de la requête
} catch (PDOException $e) {
    //echo "Connection failed: " . $e->getMessage();
    exit;
}
$conn = null;
