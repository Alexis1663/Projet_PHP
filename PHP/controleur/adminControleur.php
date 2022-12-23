<?php

require_once('modele/adminGateway.php');
require_once('modele/articleGateway.php');
require_once('modele/validation.php');
require_once('config/config.php');

class AdminControleur
{

    private $articleG;
    private $userG;
    private $adminG;

    public function __construct()
    {
        global $dns, $user, $password, $vue;

        $this->articleG = new ArticleGateway(new Connection($dns, $user, $password));
        $this->adminG = new AdminGateway(new Connection($dns, $user, $password));
        $dVueErreur = array();
        try {
            if (isset($_GET['page'])) {

                $page = $_REQUEST['page'];
            } else {
                $page = NULL;
            }

            switch ($page) {
                case NULL:
                    $lesArticles = $this->articleG->findAllA();
                    require($vue['accueil']);
                    break;
                case 'accueil':
                    $lesArticles = $this->articleG->findAllA();
                    require($vue['accueil']);
                    break;
                case "logout":
                    $MdlUser->deconnexion();
                    header("Location: index.php");
                    break;
                case "detail":
                    $detailArticle = $this->articleG->findDetailByDateTitre($_REQUEST['dateArticle'], $_REQUEST['titreArticle']);
                    require($vue['article']);
                case "supprimerArticle":
                    if (isset($_REQUEST['submit_supression'])) {
                        $this->deleteArticle($_REQUEST['dateArticle'], $_REQUEST['titreArticle']);
                        header("Location: index.php");
                    }
                    break;
                case "ajouterArticle":
                    $dVueErreur = $this->addArticle();
                    require($vue['ajoutArticle']);
                    break;
                default:
                    $dVueErreur[] = "Erreur d'appel php";
                    require($vue['erreur']);
            }
        } catch (Exception $e) {
            $dVueErreur[] = "Erreur innatendue";
            require($vue['erreur']);
        }
    }

    // Ajouter un article au blog
    public function addArticle()
    {
        $dVueErreur = array();
        if (isset($_REQUEST['formulaire_article'])) {
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
                $chemin = "vue/img/" . date('Y-m-d') . "_" . $_REQUEST['titre'] . "." . $extensionUpload;
                $move = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
                if ($move) {
                    $dVueErreur[] = $this->articleG->addA(date('Y-m-d'), $_REQUEST['titre'], $_REQUEST['contenu'], date('Y-m-d') . "_" . $_REQUEST['titre'] . "." . $extensionUpload, 0);
                    header('Location: index.php');
                } else {
                    $dVueErreur[] = "pb inportation fichier";
                    return $dVueErreur;
                }
            }
        }
        return $dVueErreur;
    }

    // Supprimer un article du blog
    public function deleteArticle(string $date, string $titre)
    {

        $this->articleG->deleteA($date, $titre);
    }

    public function deconnexion()
    {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    public function isAdmin()
    {
        if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
            $login = Validation::cleanString($_SESSION['login']);
            $role = Validation::cleanString($_SESSION['role']);
            return new Admin($login, $role);
        } else return null;
    }
}
