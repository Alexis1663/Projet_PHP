<?php

require_once 'modele/userGateway.php';
require_once 'modele/articleGateway.php';
require_once 'modele/article.php';
require_once 'vue/accueil.php';

class UserControleur {

  private $articleG;
  private $userG;
  private $article;

  public function __construct() {

    $dVueErreur=array();

    $this->articleG = new ArticleGateway();
    $this->userG = new UserGateway();
    $this->article = new Article();

    try{
        $action=$_GET['action'];
        switch($action){
            case "DeconnexionUser":
                $this->deconnexionUser();
                break;
            default:
                $dVueErreur[]="ERR : Appel PHP !";
                require($vue['erreur']);
        }
    }
    catch(Exception $e){
        $dVueErreur[]="ERR : Erreur innatendue";
        require($vue['erreur']);
    }
    exit(0);
  }


  // Ajouter un article au blog
  public function deconnexionUser() {
    $this->userG->deconnexionU();
  }


}

?>