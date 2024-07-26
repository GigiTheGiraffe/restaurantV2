<?php
try {
    $conn = new PDO(
        "mysql:host=" . getenv('DB_SERVERNAME_GALERY') . ";dbname=" . getenv('DB_NAME_GALERY'), getenv('DB_USERNAME_GALERY'), getenv('DB_PASSWORD_GALERY'));
    // Ajout des erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Preparation de la requete
    $stmt = $conn->prepare("SELECT * FROM images");
    // Execution de la requete
    $stmt->execute();
    $resultMessage = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    //echo "Connection failed: " . $e->getMessage();
    exit;
}
$conn = null;