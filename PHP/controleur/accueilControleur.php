<?php

require_once ('modele/connection.php');
require_once ('modele/articleGateway.php');

class AccueilControleur {

  //private $articleG;
  private $con;

  public function __construct($dns, $user, $password) {
    $this->con = new Connection($dns, $user, $password);
    //$this->articleG = new ArticleGateway($this->con);

    $dVueErreur=array();
    try{

      if(isset($_GET['action'])){
        $action=$_GET['action'];
      }
      else{
        $action=NULL;
      }
      switch($action){
        case NULL :
          $this->findAllArticles($dns, $user, $password);
          break;
        default :
          $dVueErreur[]="Erreur d'appel php";
          require($vue['erreur']);
      }
    } 
    catch (Exception $e){
      $dVueErreur[]="Erreur innatendue";
      require($vue['erreur']);
    }
    
  } 

  public function findAllArticles($dns, $user, $password)
  {
    global $vue;
    $this->con = new Connection($dns, $user, $password); 
    $articleG=new ArticleGateway($this->con);
    $lesArticles=$articleG->findAllA();
    require($vue['accueil']);
  }

}

?>