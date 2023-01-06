<?php

require_once('modele/articleGateway.php');
require_once('modele/article.php');
require_once('modele/validation.php');
require_once('modele/connection.php');

class MdlArticle
{

    public function detailArticle(string $date, string $titre)
    {
        global $dns, $user, $password, $rep, $vue;

        $articleG = new ArticleGateway(new Connection($dns, $user, $password));

        $detailArticle = $articleG->findDetailByDateTitre($date, $titre);
        $listCommentaire = $articleG->findAllCommentaire($date, $titre);
        require($rep . $vue['article']);
    }

    public function countCommentaire()
    {
        global $dns, $user, $password, $vue;

        $articleG = new ArticleGateway(new Connection($dns, $user, $password));
        return $articleG->countCommentaireGlobal();
    }

    public function countCommentaireUser()
    {
        global $dns, $user, $password, $vue;

        $articleG = new ArticleGateway(new Connection($dns, $user, $password));
        if (isset($_SESSION['login'])) {
            return $articleG->countCommentaireUser($_SESSION['login']);
        }
    }

    public function findAllArticles()
    {
        global $dns, $user, $password;

        $articleG = new ArticleGateway(new Connection($dns, $user, $password));
        return $articleG->findAllA();
    }

    public function findArticleByTitre(string $titre)
    {
        global $dns, $user, $password;
        $articleG = new ArticleGateway(new Connection($dns, $user, $password));
        return $articleG->findArticleByTitre($titre);
    }

    public function AddCommentaireV2()
    {
        global $dns, $user, $password;
        $dVueErreur = array();
        $articleG = new ArticleGateway(new Connection($dns, $user, $password));
        $dVueErreur = Validation::val_form_ajout_commentaire($_REQUEST['titre'], $_REQUEST['contenu'], $_REQUEST['pseudo']);
        if (empty($dVueErreur)) {
            $articleG->addCommentaire(date('Y-m-d'), $_REQUEST['titre'], $_REQUEST['pseudo'], $_REQUEST['contenu'], $_REQUEST['dateArticle'], $_REQUEST['titreArticle']);
            header("Location: index.php");
        } else {
            header("Location: index.php?page=commenter");
        }
    }
}
