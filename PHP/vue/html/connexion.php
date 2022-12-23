<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COURNONTT</title>
    <link rel="stylesheet" href="./vue/css/header_footer.css">
    <link rel="stylesheet" href="./vue/css/connexion.css">
</head>

<body>

    <!-- Début de l'entête de page -->

    <header>

        <nav>

            <div class="logo">
                <a href="index.php?page=accueil"><img src="./vue/img/logo_cournontt.png" alt="logo_cournontt"></a>
            </div>

            <div class="titre">
                <h1>COURNON TT NEWS</h1>
            </div>

            <div class="log">
                <?php if (isset($_SESSION['login'])) { ?>
                    <a href="index.php?page=logout"><button class="button">Deconnexion</button></a>
                <?php } else { ?>
                    <a href="index.php?page=connexion"><button class="button">Connexion Admin</button></a>
                <?php } ?>
            </div>

        </nav>

    </header>

    <!-- Début du corp de code -->

    <section>

        <form action="index.php?page=connexion" method="POST">
            <div class="container">

                <div class="element">
                    <label for="pseudo">Pseudo</label>
                    <input name="pseudo" type="text">
                </div>

                <div class="element">
                    <label for="mdp">Mot de passe</label>
                    <input name="mdp" type="password">
                </div>

                <?php
                foreach ($dVueErreur as $row) {
                    echo '<p style="color: red;">' . $row . '</p>';
                }
                ?>

                <input type="submit" name="formulaire_connexion" value="Confirmer">

            </div>
        </form>

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