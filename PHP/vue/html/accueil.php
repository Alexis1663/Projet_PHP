<?php

include_once('controleur/frontControleur.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COURNONTT</title>
    <link rel="stylesheet" href="vue/css/header_footer.css">
    <link rel="stylesheet" href="vue/css/accueil.css">
</head>

<body>

    <!-- Début de l'entête de page -->

    <header>

        <nav>

            <div class="logo">
                <a href="index.php?page=accueil"><img src="vue/img/logo_cournontt.png" alt="logo_cournontt"></a>
            </div>

            <div class="titre">
                <h1>COURNON TT NEWS</h1>
                <div class="sous-titre">
                    <div class="menu-recherche">
                        <input class="recherche" type="text" placeholder="Rechercher...">
                        <button>OK</button>
                    </div>
                    <p>ARTICLES POSTÉS</p>
                </div>
            </div>

            <div class="log">
                <a href="index.php?page=inscription"><button class="button">S'inscrire</button></a>
                <a href="index.php?page=connexion"><button class="button">Se connecter</button></a>
            </div>

        </nav>

    </header>

    <!-- Début du corp de code -->

    <section>

        <div class="container_article">

            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Titre</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lesArticles as $req) { ?>

                        <tr>

                            <form action="article.php">
                                <td><?= $req['date'] ?></td>
                                <td><?= $req['titre'] ?></td>
                                <td><img id="image" src="vue/img/<?= $req['image'] ?>" alt=""></td>
                                <input type="hidden" name="dateArticle" value="<?= $req['date'] ?>">
                                <input type="hidden" name="titreArticle" value="<?= $req['titre'] ?>">
                            </form>

                        </tr>

                    <?php } ?>
                </tbody>
            </table>

        </div>

    </section>

    <!-- Début du pied de page -->

    <footer>

        <div class="footer">
            <p>CL COURNON TT</p>
            <p>exemple@exemple.fr</p>
        </div>

    </footer>
</body>

</html>