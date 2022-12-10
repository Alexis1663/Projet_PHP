<?php

require_once 'modele/userGateway.php';
require_once 'modele/articleGateway.php';
require_once 'modele/article.php';
require_once 'modele/validation.php';
require_once 'vue/accueil.php';

class UserControleur {

  private $articleG;
  private $userG;
  private $article;

  public function __construct() {
    $this->articleG = new ArticleGateway();
    $this->adminG = new AdminGateway();
    $this->article = new Article();
  }

  public function connexion($login, $mdp){
    global $dns, $user, $password;

    $userG = new UserGateway(new Connection($dns, $user, $password));
    $login = Validation::cleanString($login);
    $mdp = Validation::cleanString($mdp);

    if(password_verify($mdp, $userG->getCredential($login))){
        $_SESSION['role']='user';
        $_SESSION['login']=$login;
        return new User($login, $mdp);
    }
    else NULL;

  }

  public function deconnexion(){
    session_unset();
    session_destroy();
    $_SESSION = array();
  }

  public function isUser(){
    if (isset($_SESSION['login']) && isset($_SESSION['role'])){
      $login = Validation::cleanString($_SESSION['login']);
      $role = Validation::cleanString($_SESSION['role']);
      return new User($login,$role);
    }
    else return NULL;
  }

}

?>