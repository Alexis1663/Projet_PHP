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
            </div>

            <div class="log">
                <?php if (isset($_SESSION['login'])) { ?>
                    <a href="index.php?page=ajouterArticle"><button class="button">Ajouter un article</button></a>
                    <a href="index.php?page=logout"><button class="button">Deconnexion</button></a>
                <?php } else { ?>
                    <a href="index.php?page=connexion"><button class="button">Connexion Admin</button></a>
                <?php } ?>
            </div>

        </nav>

    </header>

    <!-- Début du corp de code -->

    <section>
        <form action="index.php?page=rechercher" method="POST">
            <div class="menu-recherche">
                <input class="recherche" type="text" name="recherche" placeholder="Rechercher...">
                <input type="submit" value="Valider" name="formulaire_recherche">
            </div>
        </form>
        <?php if (isset($_SESSION['login'])) { ?>
            <p>IL Y A <?= $commentaireGlobal ?> COMMENTAIRE(S) POSTÉ(S)</p>
            <p>DONT <?= $commentaireUser ?> DE VOTRE PART</p>
        <?php } else { ?>
            <p>IL Y A <?= $commentaireGlobal ?> COMMENTAIRE(S) POSTÉ(S)</p>
        <?php } ?>


        <div class="container_article">

            <?php foreach ($lesArticles as $req) { ?>
                <div class="container_article_small">
                    <form action="index.php?page=detail" method="POST">
                        <button type="submit" name="button_detail">
                            <div class="article">
                                <img id="image" src="vue/img/<?= $req['image'] ?>" alt="Image <?= $req['image'] ?>">
                                <p><?= $req['titre'] ?></p>
                                <p><?= $req['date'] ?></p>
                                <input type="hidden" name="dateArticle" value="<?= $req['date'] ?>">
                                <input type="hidden" name="titreArticle" value="<?= $req['titre'] ?>">
                            </div>
                        </button>
                    </form>
                    <?php if (isset($_SESSION['login'])) { ?>
                        <form action="index.php?page=supprimerArticle" method="POST">
                            <button class="button" type="submit" name="submit_supression">Supprimer
                                <input type="hidden" name="dateArticle" value="<?= $req['date'] ?>">
                                <input type="hidden" name="titreArticle" value="<?= $req['titre'] ?>">
                            </button>
                        </form>
                    <?php } ?>
                </div>
            <?php } ?>



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