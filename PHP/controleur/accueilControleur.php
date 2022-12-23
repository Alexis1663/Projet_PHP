<?php

require_once('modele/connection.php');
require_once('modele/articleGateway.php');
require_once('config/config.php');
require_once('modele/MdlAdmin.php');

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
                    $commentaireGlobal = $this->articleG->countCommentaireGlobal();
                    if (isset($_SESSION['login'])) {
                        $commentaireUser = $this->articleG->countCommentaireUser($_SESSION['login']);
                    }
                    $lesArticles = $this->findAllArticles($this->con);
                    require($vue['accueil']);
                    break;
                case 'accueil':
                    $commentaireGlobal = $this->articleG->countCommentaireGlobal();
                    if (isset($_SESSION['login'])) {
                        $commentaireUser = $this->articleG->countCommentaireUser($_SESSION['login']);
                    }
                    $lesArticles = $this->findAllArticles($this->con);
                    require($vue['accueil']);
                    break;
                case "connexion":
                    $dVueErreur = $this->connexion();
                    require($vue['connexion']);
                    if ($MdlAdmin->isAdmin() != null) {
                        header("Location: index.php");
                    }
                    break;
                case "detail":
                    $detailArticle = $this->articleG->findDetailByDateTitre($_REQUEST['dateArticle'], $_REQUEST['titreArticle']);
                    $listCommentaire = $this->articleG->findAllCommentaire($_REQUEST['dateArticle'], $_REQUEST['titreArticle']);
                    require($vue['article']);
                    break;
                case "logout":
                    $this->deconnexion();
                    header("Location: index.php");
                    break;
                case "rechercher":
                    $commentaireGlobal = $this->articleG->countCommentaireGlobal();
                    if (isset($_SESSION['login'])) {
                        $commentaireUser = $this->articleG->countCommentaireUser($_SESSION['login']);
                    }
                    $lesArticles = $this->findArticleByTitre($this->con);
                    require($vue['accueil']);
                    break;
                case "commenter":
                    $this->AddCommentaireV1($_REQUEST['dateArticle'], $_REQUEST['titreArticle']);
                    //$listCommentaire = $this->articleG->findAllCommentaire();
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

    public function AddCommentaireV1(string $dateArticle, string $titreArticle)
    {
        global $vue;
        $articleG = new ArticleGateway($this->con);
        require($vue['commenter']);
    }

    public function AddCommentaireV2()
    {
        global $vue;
        $articleG = new ArticleGateway($this->con);
        if (isset($_REQUEST['formulaire_ajout_commentaire'])) {
            $articleG->addCommentaire(date('Y-m-d'), $_REQUEST['titre'], $_REQUEST['pseudo'], $_REQUEST['contenu'], $_REQUEST['dateArticle'], $_REQUEST['titreArticle']);
        }
        header('Location: index.php');
    }

    public function findArticleByTitre(Connection $con)
    {
        global $vue;
        $articleG = new ArticleGateway($con);
        if (isset($_REQUEST['formulaire_recherche'])) {
            if (isset($_REQUEST['recherche'])) {
                return $articleG->findArticleByTitre($_REQUEST['recherche']);
            }
        }
    }

    public function findAllArticles(Connection $con)
    {
        global $vue;
        $articleG = new ArticleGateway($con);
        return $articleG->findAllA();
    }

    public function connexion()
    {
        $dVueErreur = array();
        $MdlAdmin = new MdlAdmin();
        if (isset($_REQUEST['formulaire_connexion'])) {
            $dVueErreur = $MdlAdmin->connexion($_REQUEST['pseudo'], $_REQUEST['mdp']);
        }
        return $dVueErreur;
    }

    public function deconnexion()
    {
        global $vue;
        $MdlAdmin = new MdlAdmin();
        $MdlAdmin->deconnexion();
    }
}
