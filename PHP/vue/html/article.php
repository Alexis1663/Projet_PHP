<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COURNONTT</title>
    <link rel="stylesheet" href="./vue/css/header_footer.css">
    <link rel="stylesheet" href="./vue/css/accueil.css">
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

        <div class="titre">

            <h1><?php $detailArticle['titre'] ?></h1>
        </div>

        <div class="image">
            <img src="vue/img/<?php $detailArticle['image'] ?>" alt="Image test">
        </div>

        <div class="description">
            <h3><?php $detailArticle['contenu'] ?></h3>
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