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
                case "logout":
                    $this->deconnexion();
                    break;
                case "supprimerArticle":
                    $this->deleteArticle();
                    break;
                case "ajouterArticle":
                    $this->addArticle();
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
        global $vue;
        $m = new MdlAdmin();
        $dVueErreur = array();

        if (isset($_REQUEST['formulaire_article'])) {
            $dVueErreur = $m->addArticle();
        }
        require($vue['ajoutArticle']);
    }

    // Supprimer un article du blog
    public function deleteArticle()
    {
        $m = new MdlAdmin();
        if (isset($_REQUEST['submit_supression'])) {
            $m->deleteArticle($_REQUEST['dateArticle'], $_REQUEST['titreArticle']);
            header("Location: index.php");
        }
    }

    public function deconnexion()
    {
        $m = new MdlAdmin();
        $m->deconnexion();
        header("Location: index.php");
    }
}
