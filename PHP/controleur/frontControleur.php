<?php


require_once ('controleur/userControleur.php');
//require_once ('controleur/adminControleur.php';
require_once ('controleur/accueilControleur.php');


require_once ('config/config.php');
require_once('modele/connection.php');

class FrontControleur {

  private $ctrlAccueil;
  private $ctrlAdmin;
  private $ctrlUser;

  public function __construct() {

    global $user, $password, $dns;
    $this->ctrlAccueil = new AccueilControleur($dns, $user, $password);
    //$this->ctrlAdmin = new AdminControleur();
    //$this->ctrlUser = new UserControleur();
  }

  // Traite une requête entrante
  public function frontRequest(){
    global $vue;
    require_once($vue['accueil']);
    if(isset($_GET['page'])){
      $myPage = $_GET['page'];
      switch($myPage){
        default:
          require_once('../vue/html/accueil.php');
      }
    }
  }

  /* Affiche une erreur
  private function erreur($msgErreur) {
    $vue = new Vue("Erreur");
    $vue->generer(array('msgErreur' => $msgErreur));
  }*/

}

?>