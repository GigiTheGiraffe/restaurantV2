<?php
// URL de l'API Sheety pour restaurantv2
$url = 'https://api.sheety.co/4d764cbf2410c2d2cd166a9b72bbf9e7/restaurantv2/sheet1';

// Les data qui seront envoyées
$data = [
    'sheet1' => [
        'email' => $email,
        'prenom' => $firstname,
        'nom' => $lastname,
        'objet' => $selectMessage,
        'message' => $message
    ]
];

// Initialiser cURL
$ch = curl_init($url);

// Configurer les options de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Exécuter la requête et obtenir la réponse
$response = curl_exec($ch);

// Fermer cURL
curl_close($ch);

// Vérifier la réponse
if ($response) {
    $responseData = json_decode($response, true);
    if (isset($responseData['sheet1'])) {
        // Debugging
        //echo 'Ligne ajoutée avec succès : ' . print_r($responseData['sheet1'], true);
    } else {
        // Debugging
        // echo 'Erreur : ' . $response;
    }
} else {
    // Debugging
    //echo 'Erreur lors de la requête.';
}
?>