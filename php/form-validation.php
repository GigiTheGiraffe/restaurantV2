<?php
// Fonction pour nettoyer et valider les données
function test_input($data)
{
    $data = trim($data ?? '');
    $data = stripslashes($data ?? '');
    $data = htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
    return $data;
}

// Initialiser les variables
$errors = array();
$succesMessage = "";
$firstname = $lastname = $email = $message = $selectMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation du prénom
    if (empty($_POST["inputFirstname"])) {
        $errors[] = "Le prénom est requis.";
    } else {
        $firstname = test_input($_POST["inputFirstname"]);
        if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ'-]+$/", $firstname)) {
            $errors[] = "Le prénom ne doit contenir que des lettres, des traits d'union et des apostrophes ou être vide.";
        }
    }
    // Validation du nom
    if (empty($_POST["inputLastname"])) {
        $errors[] = "Le nom est requis.";
    } else {
        $lastname = test_input($_POST["inputLastname"]);
        if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ'-]+$/", $lastname)) {
            $errors[] = "Le nom ne doit contenir que des lettres, des traits d'union et des apostrophes.";
        }
    }

    // Validation de l'email
    if (empty($_POST["inputEmail"])) {
        $errors[] = "L'email est requis.";
    } else {
        $email = test_input($_POST["inputEmail"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format d'email invalide.";
        }
    }

    // Validation de select
    if (empty($_POST["selectMessage"])) {
        $errors[] = "Selectionner une raison pour votre message";
    } else {
        $selectMessage = $_POST["selectMessage"];
        $allowedValues = array("livreOr", "reservation", "service traiteur", "plainte", "autre");
        if (!in_array($selectMessage, $allowedValues)) {
            $errors[] = "Format de raison invalide.";
        }
    }

    // Validation du message
    if (empty($_POST["message"])) {
        $errors[] = "Le message est requis.";
    } else {
        $message = test_input($_POST["message"]);
        if (strlen($message) < 10 || strlen($message) > 450) {
            $errors[] = "Le message doit contenir entre 10 et 450 caractères.";
        }

        // Sécurité contre les scripts
        if (preg_match('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', $message)) {
            $errors[] = "Les scripts ne sont pas autorisés dans le message.";
        }
    }
    // Affichage des erreurs ou traitement du formulaire
    if (empty($errors)) {
        // Traitement des données si formulaire valide
        $successMessage = "Formulaire soumis avec succès, merci !";
        require 'form-processing.php';
        if ($selectMessage == "livreOr") {
        require 'sheety.php';
        }
}
}