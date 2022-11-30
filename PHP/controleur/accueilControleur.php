<?php

require_once ('modele/connection.php');
require_once ('modele/articleGateway.php');

class AccueilControleur {

  private $articleG;
  private $con;

  public function __construct($dns, $user, $password) {
    $this->con = new Connection($dns, $user, $password);
    $this->articleG = new ArticleGateway($this->con);

    /*try{
      $action=$_GET['action'];
      switch($action){
        case NULL :
          $this->findAllA();
          break;
        default :
          $dVueErreur[]="Erreur d'appel php";
          require($vue['erreur']);
      }
    } 
    catch (Exception $e){
      $dVueErreur[]="Erreur innatendue";
      require($vue['erreur']);
    }*/
    
  } 

  public function findAllArticles()
  {
    $lesArticles=$this->articleG->findAllA();
    return $lesArticles;
  }
}

?>