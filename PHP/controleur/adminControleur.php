<?php

require_once 'modele/adminGateway.php';
require_once 'modele/articleGateway.php';
require_once 'modele/article.php';
require_once 'vue/accueil.php';

class AdminControleur {

  private $articleG;
  private $adminG;
  private $article;

  public function __construct() {
    $this->articleG = new ArticleGateway();
    $this->adminG = new AdminGateway();
    $this->article = new Article();
  }

  // Ajouter un article au blog
  public function addArticle(int $id, date $date, string $titre, string $contenu, string $image, int $nmbCommentaires=0, Admin $redacteur) {
    $this->articleG->addArticle(:id,:date,:titre,:contenu,:image,:nmbCommentaires,:redacteur);
  }

  // Supprimer un article du blog
  public function deleteArticle(int $idArticle) {
    $this->articleG->deleteArticle(:idArticle);
  }

  // Mettre à jour un article du blog
  /*public function updateArticle(int $id, string $newContenu){
    $this->articleG->updateArticle(:id,"");
  }*/


  // Ajouter un utilisateur à la base de données
  public function addUser(string $pseudo, string $nom, string $prenom, string $motDePasse, int $nmbCommentairesEcrits) {
    $this->adminG->addUser(:pseudo,:nom,:prenom,:motDePasse,:nmbCommentairesEcrits);
  }


  // Supprimer un utilisateur de la base de données
  public function deleteUser(string $pseudoUser) {
    $this->adminG->deleteUser(:pseudoUser);
  }

}

?>