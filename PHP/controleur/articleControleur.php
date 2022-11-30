<?php

require_once('modele/articleGateway.php');
require_once('modele/connection.php');


class ArticleControleur
{

    private $articleG;
    private $con;

    public function __construct($dns, $user, $password)
    {
        $this->con = new Connection($dns, $user, $password);
        $this->articleG = new ArticleGateway($this->con);
    }

    // Affiche la liste de tous les articles du blog
    public function findAllArticles()
    {
        $lesArticles = $this->articleG->findAllA();
    }

}


?>