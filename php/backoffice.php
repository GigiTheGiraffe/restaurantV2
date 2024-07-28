<?php
include 'load-env.php';
loadEnv(__DIR__ . './.env');
include 'read-message.php';
include 'delete.php';
include 'readImages.php';
include 'upload.php';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Backoffice La Cantine</title>
    <link href="../css/backoffice-style.css" rel="stylesheet">
</head>

<body class="bg-secondary">
    <header>
        <img src="../images/logo.png" alt="Logo La Cantine">
        <h1>Backoffice pour le restaurant La Cantine</h1>
    </header>
    <main>
        <section class="containerPerso">
            <nav>
                <a href="#messages">
                    <h2>Messages</h2>
                </a>
                <a href="#livreOr">
                    <h2>Livre d'Or</h2>
                </a>
                <a href="#galerie">
                    <h2>Galerie</h2>
                </a>
            </nav>
            <div class="table-container switch" id="messages">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Email</th>
                            <th>Nom</th>
                            <th>Sujet</th>
                            <th>Message</th>
                            <th colspan="1">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contenu de la table messages -->
                        <?php
                        foreach ($resultMessage as $row) {
                        ?>
                            <tr>
                                <td><?= $row['date'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['nom'] ?></td>
                                <td><?= $row['objet'] ?></td>
                                <td><?= $row['message'] ?></td>
                                <td>
                                    <form method="post"><button type="submit" name="deleteBtn" class="btn" value="<?= $row['id'] ?>">Supp</button></form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="table-container switch" id="livreOr">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th colspan="1">Email</th>
                            <th>Nom</th>
                            <th>Sujet</th>
                            <th>Message</th>
                            <th colspan="1">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contenu de la table du livre d'or -->
                        <?php
                        foreach ($resultMessage as $row) {
                            if ($row['objet'] == "livreOr") {
                        ?>
                                <tr>
                                    <td><?= $row['date'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['nom'] ?></td>
                                    <td><?= $row['objet'] ?></td>
                                    <td><?= $row['message'] ?></td>
                                    <td>
                                        <form method="post"><button type="submit" name="deleteBtn" class="btn" value="<?= $row['id'] ?>">Supp</button></form>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="table-container switch" id="galerie">
                <section>
                    <form class="form" method="post" enctype="multipart/form-data">
                        <label for="image">Choisissez une image de moins de 5Mo :</label>
                        <input type="file" name="image" id="image" accept=".jpeg,.webp,.pdf,.png" required>
                        <br><br>

                        <label for="imageName">Nom de l'image :</label>
                        <input type="text" name="imageName" id="imageName" required>
                        <br><br>

                        <button type="submit">Uploader l'image</button>
                    </form>
                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Path</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Contenu de la table initial -->
                            <?php
                            foreach ($resultGalery as $row) {
                            ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['path'] ?></td>
                                    <td>
                                        <form method="post"><button type="submit" name="deleteBtn" class="btn" value="<?= $row['name'] ?>">Supp</button></form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </section>
    </main>
    <script src="../js/backoffice.js" crossorigin="anonymous"></script>
</body>

</html>