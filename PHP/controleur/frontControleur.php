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
        } catch (EXCEPTION $e) {
        }
    }

    // Traite une requête entrante
    public function frontRequest()
    {
        global $vue;

        $lesArticles = $this->ctrlAccueil->findAllArticles();
    }

    /* Affiche une erreur
  private function erreur($msgErreur) {
    $vue = new Vue("Erreur");
    $vue->generer(array('msgErreur' => $msgErreur));
  }*/
}
