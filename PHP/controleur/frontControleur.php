<?php

require_once('modele/MdlAdmin.php');
require_once('config/config.php');
require_once('modele/connection.php');

class FrontControleur
{

    private $ctrlAccueil;
    //private $ctrlAdmin;
    //private $ctrlUser;

    //Controller that join the action of son's controller
    public function __construct()
    {
        global $rep, $vue, $user, $password, $dns; // pour utiliser les variables globales : le répertoire, les vues, le login, le mot de passe et le dns
        $listeActionAdmin = array('ajouterArticle', 'supprimerArticle');

        //$this->ctrlFromage = new FromageControleur($dns, $user, $password);


        //Création d'un tableau d'erreur
        $dVueErreur = array();

        session_start();
        try {
            $adminSite = MdlAdmin::isAdmin();

            if (isset($_REQUEST['page'])) {
                $action = $_REQUEST['page'];
            } else {
                $action = NULL;
            }

            //On vérifie que l'action soit une action pour un utilisateur connecté
            if (in_array($action, $listeActionAdmin)) {
                //Si oui, mais que l'utilisateur n'est pas connecté
                if ($adminSite == NULL) {
                    require($rep . $vue['connexion']);
                }
                //Sinon
                else {
                    new AdminControleur();
                }
            }
            //Sinon
            else {
                new AccueilControleur($dns, $user, $password);
            }

            //Si une erreur est survenue
        } catch (Exception $e) {
            $dVueErreur[] = "Erreur Inconnue";
            require($rep . $vue['erreur']);
        }
    }

    /* Affiche une erreur
  private function erreur($msgErreur) {
    $vue = new Vue("Erreur");
    $vue->generer(array('msgErreur' => $msgErreur));
  }*/
}
