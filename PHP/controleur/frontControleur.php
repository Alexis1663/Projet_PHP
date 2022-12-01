<?php


//require_once ('controleur/userControleur.php');
//require_once ('controleur/adminControleur.php';
require_once 'controleur/accueilControleur.php';


require_once('config/config.php');
require_once('modele/connection.php');

class FrontControleur
{

    private $ctrlAccueil;
    //private $ctrlAdmin;
    //private $ctrlUser;

    public function __construct()
    {
        try {
            global $user, $password, $dns, $vue;
            $this->ctrlAccueil = new AccueilControleur($dns, $user, $password);

            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = NULL;
            }

            switch ($page) {
                case NULL:
                    require($vue['accueil']);
                    break;
                case "inscription":
                    require($vue['inscription']);
                    break;
                case "connexion":
                    require($vue['connexion']);
                    break;
            }
        } catch (EXCEPTION $e) {
        }
    }

    // Traite une requête entrante
    public function frontRequest()
    {
        global $vue;

        $articles = $this->ctrlAccueil->findAllArticles();
        require_once($vue['accueil']);
    }

    /* Affiche une erreur
  private function erreur($msgErreur) {
    $vue = new Vue("Erreur");
    $vue->generer(array('msgErreur' => $msgErreur));
  }*/
}
