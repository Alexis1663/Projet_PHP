<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COURNONTT</title>
    <link rel="stylesheet" href="vue/css/header_footer.css">
    <link rel="stylesheet" href="vue/css/article.css">
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

        <?php foreach ($detailArticle as $row) { ?>

            <div class="parent-container">

                <div class="header-container">
                    <img src="vue/img/<?= $row['image'] ?>" alt="Image <?php $row['image'] ?>">
                    <h1 id="titreArticle"><?= $row['titre'] ?></h1>
                    <h1><?= $row['date'] ?></h1>
                </div>

                <div class="description">
                    <h1>Description</h1>
                    <h3><?= $row['contenu'] ?></h3>
                </div>

            </div>



        <?php } ?>

        <div class="container_commentaire">
            <h2>Espace commentaire</h2>
            <form action="index.php?page=commenter" method="POST">
                <input type="hidden" name="titreArticle" value="<?= $row['titre'] ?>">
                <input type="hidden" name="dateArticle" value="<?= $row['date'] ?>">
                <input type="submit" value="Dites quelque chose !!!">
            </form>
            <?php foreach ($listCommentaire as $row) { ?>

                <div class="commentaire">

                    <div class="left">
                        <p><?= $row['pseudo'] ?></p>
                    </div>
                    <div class="right">
                        <div class="sur">
                            <p><?= $row['titre'] ?></p>
                            <p><?= $row['date'] ?></p>
                        </div>
                        <div class="sous">
                            <p><?= $row['contenu'] ?></p>
                        </div>
                    </div>

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