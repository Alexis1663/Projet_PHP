<?php

require_once 'modele/adminGateway.php';
require_once 'modele/articleGateway.php';
require_once 'modele/article.php';
require_once 'modele/validation.php';
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
  public function addArticle(int $id, DateTime $date, string $titre, string $contenu, string $image, int $nmbCommentaires=0, Admin $redacteur) {
    $this->articleG->addA($id,$date,$titre,$contenu,$image,$nmbCommentaires,$redacteur);
  }

  // Supprimer un article du blog
  public function deleteArticle(int $idArticle) {
    $this->articleG->deleteA($idArticle);
  }

  // Mettre à jour un article du blog
  /*public function updateArticle(int $id, string $newContenu){
    $this->articleG->updateArticle($id,"");
  }*/


  // Ajouter un utilisateur à la base de données
  public function addUser(string $pseudo, string $nom, string $prenom, string $motDePasse, int $nmbCommentairesEcrits) {
    $this->adminG->addU($pseudo,$nom,$prenom,$motDePasse,$nmbCommentairesEcrits);
  }


  // Supprimer un utilisateur de la base de données
  public function deleteUser(string $pseudoUser) {
    $this->adminG->deleteU($pseudoUser);
  }

  public function connexion($login, $mdp){
    global $dns, $user, $password;

    $adminG = new AdminGateway(new Connection($dns, $user, $password));
    $login = Validation::cleanString($login);
    $mdp = Validation::cleanString($mdp);

    if(password_verify($mdp, $adminG->getCredential($login))){
        $_SESSION['role']='admin';
        $_SESSION['login']=$login;
        return new Admin($login, $mdp);
    }
    else NULL;

  }

  public function deconnexion(){
    session_unset();
    session_destroy();
    $_SESSION = array();
  }

  public function isAdmin(){
    if (isset($_SESSION['login']) && isset($_SESSION['role'])){
      $login= Validation::cleanString($_SESSION['login']);
      $role=Validation::cleanString($_SESSION['role']);
      return new Admin($login,$role);
    }
    else return null;
  }

}

?>