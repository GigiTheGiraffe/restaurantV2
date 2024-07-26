<?php

if (isset($_POST['deleteBtn']))  {
try {
    $conn = new PDO(
        "mysql:host=" . getenv('DB_SERVERNAME_DELETE') . ";dbname=" . getenv('DB_NAME_DELETE'), getenv('DB_USERNAME_DELETE'), getenv('DB_PASSWORD_DELETE'));
    // Ajout des erreurs de PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Recuperation de l'id a delete
    $id = $_POST['deleteBtn'];
    if (is_numeric($id)) {
        $stmt = $conn->prepare("DELETE FROM messages WHERE id = :id");
            // Liaison du parametre
        $stmt->bindParam(':id', $id);
    } else {
        $stmt = $conn->prepare("DELETE FROM images WHERE name = :name");
            // Liaison du parametre
        $stmt->bindParam(':name', $id);
    }
    // Exécution de la requete
    $stmt->execute();
    header("Location: " . $_SERVER['PHP_SELF']);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
$conn = null;
// Supprimer sur sheety aussi si le temps
}