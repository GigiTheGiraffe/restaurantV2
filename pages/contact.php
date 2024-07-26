<?php
include '../php/load-env.php';
loadEnv(__DIR__ . '/../php/.env'); 
require '../php/form-validation.php';
$messageErreur = "";
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contacter La Cantine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/styles.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a4b4ca04e3.js" crossorigin="anonymous"></script>
</head>

<body class="bg-vanilla text-blue mb-0">
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.html">
                    <img src="../images/logo.png" alt="Logo La Cantine" height="40" width="94.34">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-lg-end text-uppercase" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="menu.html">Menu</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="galerie.html">Galerie</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link" href="restaurant.html">Restaurant</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="container mb-5">
            <h1 class="text-center fst-italic text-decoration-underline mt-3 mb-2">Nous contacter</h1>
            <?php
            // Afficher erreur ou succès formulaire
            if (!empty($errors)) {
                echo '<section class="alert alert-danger mt-2">';
                foreach ($errors as $error) {
                    echo '<p class="text-center">' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</p>';
                }
                echo '</section>';
            }
            if (!empty($successMessage)) {
                echo '<section class="alert alert-success mt-2">';
                echo '<p class="text-center">' . htmlspecialchars($successMessage, ENT_QUOTES, 'UTF-8') . '</p>';
                echo '</section>';
            }
            if ($messageErreur !='') {
                echo '<section class="alert alert-danger mt-2">';
                echo "<p class=\"text-center\"> $messageErreur </p>";
                echo '</section>';
            }
            ?>
            <p class="mt-5">Veuiller remplir tous les champs du formulaire s'il vous plait.
                <br>
                Nous vous répondrons le plus rapidement possible
            </p>
            <form class="mt-5" id="contact" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="row col-12 text-start d-flex justify-content-between mx-auto">
                    <div class="col-5 mb-2 px-0">
                        <label for="inputFirstname" class="col-form-label">Prénom</label>
                        <input type="text" name="inputFirstname" class="form-control" id="inputFirstname" pattern="^[A-Za-zÀ-ÖØ-öø-ÿ'-]+$" maxlength="50" title="Le prénom ne doit contenir que des lettres, des traits d'union et des apostrophes." required>
                    </div>
                    <div class="col-5 mb-2 px-0">
                        <label for="inputLastname" class="col-form-label">Nom</label>
                        <input type="text" name="inputLastname" class="form-control" id="inputLastname" pattern="^[A-Za-zÀ-ÖØ-öø-ÿ'-]+$" maxlength="50" title="Le nom ne doit contenir que des lettres, des traits d'union et des apostrophes." required>
                    </div>
                    <div class="col-12 mb-2 px-0">
                        <label for="inputEmail" class="col-form-label">Adresse email</label>
                        <input type="email" name="inputEmail" class="form-control" id="inputEmail" aria-describedby="confidentialitéEmail" required>
                        <div id="confidentialitéEmail" class="text-blue form-text">Votre email ne sera pas partagé avec des services tiers</div>
                    </div>
                    <div class="col-12 mb-2 px-0">
                        <label for="selectMessage" class="col-form-label">Raison de votre message</label>
                        <select name="selectMessage" id="selectMessage" class="form-select mb-2" aria-label="Selectionnez votre choix" required>
                            <option value="livreOr">Avis pour le livre d'or</option>
                            <option value="reservation">Réservation</option>
                            <option value="service traiteur">Service traiteur</option>
                            <option value="plainte">Plainte</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="col-12 mb-2 px-0">
                        <label for="zoneTexte" class="col-form-label mb-3">Veuillez-nous expliquer votre choix.</label>
                        <textarea name="message" class="form-control" id="zoneTexte" rows="5" minlength="10" maxlength="450" required></textarea>
                    </div>
                    <div class="form-check mb-2 px-4">
                        <input type="checkbox" class="form-check-input" id="marketing">
                        <label class="form-check-label mb-3" for="marketing">J'accepte de recevoir des offres promotionnelles de la part de La Cantine.</label>
                    </div>
                    <button type="submit" class="mb-5 col-12 col-md-2 btn btn-danger">Envoyer</button>
                </div>
            </form>

        </section>
    </main>
    <footer class="container-fluid pt-md-1 pt-2 pb-1 fixed-bottom">
        <div class="row align-items-center justify-content-evenly">
            <button type="button" class="col-3 btn" aria-label="Lien twitter"><a class="text-blue" href="https://x.com/?lang=fr"><i class="fa-brands fa-twitter fa-2xl"></i></a></button>
            <button type="button" class="col-3 btn" aria-label="Lien facebook"><a class="text-blue" href="https://www.facebook.com/"><i class="fa-brands fa-facebook fa-2xl"></i></a></button>
            <button type="button" class="col-3 btn" aria-label="Lien instagram"><a class="text-blue" href="https://www.instagram.com/"><i class="fa-brands fa-instagram fa-2xl"></i></a></button>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn col-12 col-md-3 btn-lg btn-danger" role="button">Commander</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../js/form-validation.js" crossorigin="anonymous"></script>
</body>

</html>
