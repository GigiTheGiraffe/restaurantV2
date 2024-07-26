<?php
include '../php/load-env.php';
loadEnv(__DIR__ . '/../php/.env');
include '../php/createGalery.php';
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galerie La Cantine</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="../css/styles.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a4b4ca04e3.js" crossorigin="anonymous"></script>
</head>

<body class="bg-vanilla text-blue mb-5 pb-5">
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
              <a class="nav-link active" aria-current="page" href="galerie.php">Galerie</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="restaurant.html">Restaurant</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link" href="contact.php">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main class="my-lg-4">
    <div class="container text-center">
      <h1 class="fst-italic my-md-5 text-decoration-underline">Galerie</h1>

      <?php
      $count = 0;
      $id = 0;
      $numberElements = count($resultMessage);
      while ($count < $numberElements) {
        // Boucle qui imrime la première partie de la section sur les 3 images
        if ($count % 3 == 0) {
          if ($count > 0) {
            // Ferme le div de la page d'avant si pas la première itération
            echo '</div></div>';
          }
          $id++;
          echo "<div id=\"page-$id\" class=\"gallery-page\">";
          echo '<div class="row">';
        }

        // Boucle qui imprime les images par 3 tout en gardant l'endroit ou ça s'arrete (array des images) pour fermer la page
        for ($i = 0; $i < 3 && $count < $numberElements; $i++, $count++) {
          $message = $resultMessage[$count];
          echo '<div class="col-md-4 mb-4">';
          echo "<img src=\"$message[path]\" class=\"img-fluid\" alt=\"$message[name]\">";
          echo '</div>';
        }
      }

      // Ferme le dernier div de page s'il n'y a plus d'image a afficher.
      if ($count == $numberElements) {
        echo '</div></div>';
      }
      ?>
      <!-- Pagination -->
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center mt-4">
          <?php
          $i = 1;
          $id++;
          // Imprime les boutons de pagination jusqu'a atteindre le nombre id qui correspond au nombre de pages local des images
          while ($i < $id) {
            echo "<li class=\"page-item\"><a class=\"page-link\" href=\"#page-$i\">$i</a></li>";
            $i++;
          }
          ?>
        </ul>
      </nav>
    </div>
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
  <script src="../js/pagination.js"></script>
</body>

</html>