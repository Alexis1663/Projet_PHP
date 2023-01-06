<?php

require_once('modele/connection.php');

class ArticleGateway
{

    private $con;

    /**
     * generate
     *
     * @param $con 
     *
     * @return void
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * find all the article in the database
     *
     * @return array of article
     **/
    public function findAllA(): array
    {
        $queryfindall = "SELECT * FROM Article";
        $this->con->executeQuery($queryfindall);
        $results = $this->con->getResults();
        return $results;
    }

    /**
     * find an article with his date
     *
     * @param $date : publication's date of an article 
     *
     * @return array of article
     **/
    public function findArticleByDate(DateTime $date): array
    {
        $queryfind = "SELECT * FROM Article WHERE date=:date";
        $this->con->executeQuery($queryfind, array(':date' => array($date, PDO::PARAM_STR)));
        $results = $this->con->getResults();
        return $results;
    }

    public function findArticleByTitre(string $titre): array
    {
        $queryfind = "SELECT * FROM Article WHERE titre LIKE :titre";
        $this->con->executeQuery($queryfind, array(':titre' => array("%" . $titre . "%", PDO::PARAM_STR)));
        return $this->con->getResults();
    }

    public function findDetailByDateTitre(string $date, string $titre): array
    {
        $queryfind = "SELECT * FROM Article WHERE date=:date AND titre = :titre";
        $this->con->executeQuery($queryfind, array(
            ':date' => array($date, PDO::PARAM_STR),
            ':titre' => array($titre, PDO::PARAM_STR)
        ));
        return $this->con->getResults();
    }



    /**
     * update the text of an article
     *
     * @param $id : primary key of an article
     * @param $newContenu : new content to put in the article's section
     *
     * @return void
     **/
    public function updateA(string $date, string $titre, string $newContenu)
    {
        $queryupdate = "UPDATE Article SET contenu=:newContenu WHERE date=:date AND titre=:titre";
        $this->con->executeQuery($queryupdate, array(
            ':date' => array($date, PDO::PARAM_STR),
            ':titre' => array($titre, PDO::PARAM_STR)
        ));
    }

    public function addCommentaire(string $date, string $titre, string $pseudo, string $contenu, string $dateArticle, string $titreArticle)
    {
        $queryAdd = "INSERT INTO Commentaire VALUES (:dateArticle,:titreArticle,:titre,:pseudo,:contenu,:date)";
        $queryIncrementer = 'UPDATE Article SET nmbCommentaires = nmbCommentaires + 1 WHERE date = :date AND titre = :titre;';
        $this->con->executeQuery($queryAdd, array(
            ':dateArticle' => array($dateArticle, PDO::PARAM_STR),
            ':titreArticle' => array($titreArticle, PDO::PARAM_STR),
            ':titre' => array($titre, PDO::PARAM_STR),
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':contenu' => array($contenu, PDO::PARAM_STR),
            ':date' => array($date, PDO::PARAM_STR)
        ));

        $this->con->executeQuery($queryIncrementer, array(
            ':date' => array($dateArticle, PDO::PARAM_STR),
            ':titre' => array($titreArticle, PDO::PARAM_STR)
        ));
    }

    public function findAllCommentaire(string $date, string $titre): array
    {
        $queryFindAll = "SELECT * FROM Commentaire WHERE dateArticle=:dateArticle AND titreArticle=:titreArticle";
        $this->con->executeQuery($queryFindAll, array(
            ':dateArticle' => array($date, PDO::PARAM_STR),
            ':titreArticle' => array($titre, PDO::PARAM_STR)
        ));
        $results = $this->con->getResults();
        return $results;
    }

    public function countCommentaireGlobal()
    {
        $queryFindAll = "SELECT count(*) FROM Commentaire";
        $this->con->executeQuery($queryFindAll);
        $results = $this->con->getResults()[0][0];
        return $results;
    }

    public function countCommentaireUser(string $pseudo)
    {
        $queryFindAllUser = "SELECT count(*) FROM Commentaire WHERE pseudo=:pseudo";
        $this->con->executeQuery($queryFindAllUser, array(
            ':pseudo' => array($pseudo, PDO::PARAM_STR)
        ));
        $results = $this->con->getResults()[0][0];
        return $results;
    }
}
