<?php

require_once('modele/connection.php');
require_once('modele/articleGateway.php');

class AccueilControleur
{

    //private $articleG;
    private $con;

    public function __construct($dns, $user, $password)
    {
        global $vue;
        $this->con = new Connection($dns, $user, $password);
        //$this->articleG = new ArticleGateway($this->con);

        $dVueErreur = array();
        try {
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = NULL;
            }

            switch ($page) {
                case NULL:
                    $this->findAllArticles($this->con);
                    break;
                case 'accueil':
                    $this->findAllArticles($this->con);
                    break;
                case "inscription":
                    require($vue['inscription']);
                    break;
                case "connexion":
                    require($vue['connexion']);
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

    public function findAllArticles(Connection $con)
    {
        global $vue;
        $articleG = new ArticleGateway($con);
        $lesArticles = $articleG->findAllA();
        require($vue['accueil']);
    }
}
