<?php

require_once ('modele\connection.php');
require_once ('modele\articleGateway.php');

class AccueilControleur {

  private $articleG;
  private $con;

  public function __construct($dns, $user, $password) {
    $this->con = new Connection($dns, $user, $password);
    $this->articleG = new ArticleGateway($this->con);
  }

  // Affiche la liste de tous les articles du blog
  public function accueil() {
    $lesArticles = $this->articleG->findAllA();
  }

}

?>