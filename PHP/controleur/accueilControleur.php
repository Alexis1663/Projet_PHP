<?php

require_once('modele/connection.php');
require_once('modele/articleGateway.php');
require_once('config/config.php');
require_once('modele/MdlArticle.php');

class AccueilControleur
{

    //private $articleG;
    private $con;
    private $articleG;

    public function __construct($dns, $user, $password)
    {
        global $vue;

        $this->con = new Connection($dns, $user, $password);

        $this->articleG = new ArticleGateway($this->con);

        $MdlAdmin = new MdlAdmin();

        $dVueErreur = array();
        try {
            if (isset($_GET['page'])) {
                $page = $_REQUEST['page'];
            } else {
                $page = NULL;
            }

            switch ($page) {
                case NULL:
                    $this->accueil();
                    break;
                case 'accueil':
                    $this->accueil();
                    break;
                case "connexion":
                    $this->connexion();
                    break;
                case "detail":
                    $this->detailArticle();
                    break;
                case "rechercher":
                    $this->rechercher();
                    break;
                case "commenter":
                    $this->AddCommentaireV1($_REQUEST['dateArticle'], $_REQUEST['titreArticle'], $dVueErreur);
                    break;
                case "ajouterCommentaire":
                    $this->AddCommentaireV2();
                    break;
            }
        } catch (Exception $e) {
            $dVueErreur[] = "Erreur innatendue";
            require($vue['erreur']);
        }
    }

    public function rechercher()
    {
        global $vue;
        $m = new MdlArticle();
        if (isset($_REQUEST['formulaire_recherche'])) {
            $lesArticles = $m->findArticleByTitre($_REQUEST['recherche']);
            $commentaireGlobal = $m->countCommentaire();
            $commentaireUser = $m->countCommentaireUser();
            require($vue['accueil']);
        }
    }

    public function accueil()
    {
        global $vue;
        $m = new MdlArticle();
        $lesArticles = $m->findAllArticles();
        $commentaireGlobal = $m->countCommentaire();
        $commentaireUser = $m->countCommentaireUser();
        require($vue['accueil']);
    }

    public function detailArticle()
    {
        $m = new MdlArticle();
        if (isset($_REQUEST['button_detail'])) {
            $m->detailArticle($_REQUEST['dateArticle'], $_REQUEST['titreArticle']);
        }
    }

    public function connexion()
    {
        global $vue;
        $m = new MdlAdmin();
        $dVueErreur = array();
        if (isset($_REQUEST['formulaire_connexion'])) {
            $dVueErreur = $m->connexion($_REQUEST['pseudo'], $_REQUEST['mdp']);
        }
        require($vue['connexion']);
        if ($m->isAdmin() != null) {
            header("Location: index.php");
        }
    }

    public function AddCommentaireV1(string $dateArticle, string $titreArticle, array $dVueErreur)
    {
        global $vue;
        require($vue['commenter']);
    }

    public function AddCommentaireV2()
    {
        $m = new MdlArticle();
        if (isset($_REQUEST['formulaire_ajout_commentaire'])) {
            $m->AddCommentaireV2();
        }
    }
}
