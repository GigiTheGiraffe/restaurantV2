<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Vérifier si le fichier a été téléchargé sans erreur
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = $_POST['imageName'];
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileName = $_FILES['image']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newFileName = $imageName . '.' . $fileExtension;

        // Définir un dossier où stocker l'image
        $path = $_SERVER['DOCUMENT_ROOT'] . '/restaurantV2/images/' . $newFileName;
        // Vérifiez la taille du fichier (limite à 5 Mo par exemple)
        if ($fileSize > 5000000) {
            $erreur = 'Erreur: La taille du fichier est trop grande.';
            exit;
        }

        // Verification server-side du type de l'image
        $typesAllowed = ['image/jpeg', 'image/png', 'image/webp', 'image/pdf'];
        if (!in_array($fileType, $typesAllowed)) {
            $erreur = 'Erreur: Type de fichier non autorisé.';
            exit;
        }

        // Déplacer le fichier téléchargé vers le dossier de destination
        if (move_uploaded_file($fileTmpPath, $path)) {
            $succes = 'L\'image a été téléchargée avec succès.';
            try {
                $conn = new PDO("mysql:host=" . getenv('DB_SERVERNAME_IMAGES') . ";dbname=" . getenv('DB_NAME_IMAGES'), getenv('DB_USERNAME_IMAGES'), getenv('DB_PASSWORD_IMAGES'));
                // Ajout des erreurs de PDO
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Préparation de la requête d'insertion
                $path = '../images/' . $newFileName;
                $data = [
                    ':name' => $imageName,
                    ':path' => $path
                ];
                // Preparation de la requete
                $stmt = $conn->prepare("INSERT INTO images (path, name) VALUES (:path, :name)");
            
                // Bind parameters
                foreach ($data as $param => $value) {
                    $stmt->bindValue($param, $value);
                }
                // Exécution de la requête
                $stmt->execute();
            } catch (PDOException $e) {
                // echo "Connection failed: " . $e->getMessage();
                // $messageErreur = "Connection impossible à la base de donnée, pourriez-vous contacter le propriétaire s'il vous plait?";
                // echo $messageErreur;
                exit;
            }
            $conn = null;
            // header("Location: " . $_SERVER['PHP_SELF']);
        } else {
            //$erreur = 'Erreur lors du téléchargement du fichier.';
            //echo $erreur;
            exit;
        }
    }
}
