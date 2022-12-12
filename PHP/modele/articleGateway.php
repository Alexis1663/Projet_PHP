<?php

include_once('article.php');
include_once('connection.php');

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
    public function findA(DateTime $date): array
    {
        $queryfind = "SELECT * FROM Article WHERE date=:date";
        $this->con->executeQuery($queryfind, array(':date' => array($date, PDO::PARAM_STR)));
        $results = $this->con->getResults();
        return $results;
    }

    public function findDetailByDateTitre(DateTime $date, string $titre): array
    {
        $queryfind = "SELECT * FROM Article WHERE date=:date AND titre = :titre";
        $this->con->executeQuery($queryfind, array(
            ':date' => array($date, PDO::PARAM_STR),
            ':titre' => array($date, PDO::PARAM_STR)
        ));
        $results = $this->con->getResults();
        return $results;
    }

    /**
     * add an article in the database
     *
     * @param $id : primary key of an article
     * @param $date : publication's date of an article 
     * @param $titre : article's title
     * @param $contenu : article's content
     * @param $image : article's image
     * @param $nmbCommentaires : number of commentary under an article
     * @param $redacteur : redactor of an article
     * 
     * @return void
     **/
    public function addA(int $id, DateTime $date, string $titre, string $contenu, string $image, int $nmbCommentaires = 0, Admin $redacteur)
    {
        $queryadd = "INSERT INTO Article VALUES (:id,:date,:titre,:contenu,:image,:nmbCommentaires,:redacteur)";
        $this->con->executeQuery($queryadd, array(':id' => array($id, PDO::PARAM_STR), ':date' => array($date, PDO::PARAM_STR), 'titre' => array($titre, PDO::PARAM_STR), 'contenu' => array($contenu, PDO::PARAM_STR), 'image' => array($image, PDO::PARAM_STR), 'nmbCommentaires' => array($nmbCommentaires, PDO::PARAM_STR), 'redacteur' => array($redacteur, PDO::PARAM_STR)));
    }

    /**
     * update the text of an article
     *
     * @param $id : primary key of an article
     * @param $newContenu : new content to put in the article's section
     *
     * @return void
     **/
    public function updateA(int $id, string $newContenu)
    {
        $queryupdate = "UPDATE Article SET contenu=:newContenu WHERE id=:id";
        $this->con->executeQuery($queryupdate, array(':id' => array($id, PDO::PARAM_STR), array(':contenu' => array($newContenu))));
    }

    /**
     * delete an article
     *
     * @param $id : primary key of an article
     *
     * @return void
     **/
    public function deleteA(int $id)
    {
        $querydelete = "DELETE FROM Article WHERE id=:id";
        $this->con->executeQuery($querydelete, array(':id' => array($id, PDO::PARAM_STR)));
    }

    /**
     * count the number of commentary under an article
     *
     * @param $id : primary key of an article
     *
     * @return int : number obtained
     **/
    public function countCommentairesA(int $id)
    {
    }
}
