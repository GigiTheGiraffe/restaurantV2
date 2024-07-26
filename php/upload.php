<?php
// Check si l'image est envoyée et existe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['image'])) {

    } else {
        echo "Une erreur est survenue";
    }
}