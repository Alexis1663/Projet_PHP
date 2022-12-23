<?php

require_once('modele/connection.php');

class ArticleGateway
{

    private $con;

    /**
     * generate the article gateway constructor
     *
     * @param $con : connection's parameters
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
     * @return array : array of article
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
     * @return array : array of article
     **/
    public function findArticleByDate(DateTime $date): array
    {
        $queryfind = "SELECT * FROM Article WHERE date=:date";
        $this->con->executeQuery($queryfind, array(':date' => array($date, PDO::PARAM_STR)));
        $results = $this->con->getResults();
        return $results;
    }

    /**
    * find an article with his title
    *
    * @param $titre : title of the article looking for
    *
    * @return array : article corresponding to the title given
    **/
    public function findArticleByTitre(string $titre): array
    {
        $queryfind = "SELECT * FROM Article WHERE titre LIKE :titre";
        $this->con->executeQuery($queryfind, array(':titre' => array("%" . $titre . "%", PDO::PARAM_STR)));
        return $this->con->getResults();
    }

    /**
    * find an article with his title and date
    *
    * @param $titre : title of the article looking for
    * @param $date : date of the article looking for
    *
    * @return array : article corresponding to the title given
    **/
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
    public function addA($date, string $titre, string $contenu, $image, int $nmbCommentaires = 0)
    {
        $queryadd = "INSERT INTO Article VALUES (:date,:titre,:contenu,:image,:nmbCommentaires)";
        $dVueErreur = array();
        $titre = Validation::cleanString($titre);
        $contenu = Validation::cleanString($contenu);
        $dVueErreur = Validation::val_form_ajout_article($titre, $contenu, $image);
        if (empty($dVueErreur)) {
            $this->con->executeQuery($queryadd, array(
                ':date' => array($date, PDO::PARAM_STR),
                ':titre' => array($titre, PDO::PARAM_STR),
                ':contenu' => array($contenu, PDO::PARAM_STR),
                ':image' => array($image, PDO::PARAM_STR),
                ':nmbCommentaires' => array($nmbCommentaires, PDO::PARAM_INT),
            ));
        } else {
            return $dVueErreur;
        }
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

    /**
     * delete an article
     *
     * @param $id : primary key of an article
     *
     * @return void
     **/
    public function deleteA(string $date, string $titre)
    {
        $query = 'DELETE FROM Article WHERE date=:date AND titre=:titre';
        $queryCommentaireAssocie = "DELETE FROM Commentaire WHERE dateArticle=:date AND titreArticle=:titre";
        $this->con->executeQuery($query, array(
            ':date' => array($date, PDO::PARAM_STR),
            ':titre' => array($titre, PDO::PARAM_STR)
        ));
        $this->con->executeQuery($queryCommentaireAssocie, array(
            ':date' => array($date, PDO::PARAM_STR),
            ':titre' => array($titre, PDO::PARAM_STR)
        ));
    }

     /**
     * add a commentary under an article
     *
     * @param $date : publication's date of the commentary 
     * @param $titre : commentary's title
     * @param $pseudo : pseudo of the commentary's redactor
     * @param $contenu : commentary's content
     * @param $dateArticle : date of the article where the commentary is written
     * @param $titreArticle : title of the article where the commentary is written
     * 
     * @return void
     **/    
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

    /**
    * find all the commentary under an article
    *
    * @param $titre : title of the article looking for
    * @param $date : date of the article looking for
    *
    * @return array : list of commentary under an article
    **/
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

    /**
    * count the total number of commentary on the website
    *
    * @return void
    **/
    public function countCommentaireGlobal()
    {
        $queryFindAll = "SELECT count(*) FROM Commentaire";
        $this->con->executeQuery($queryFindAll);
        $results = $this->con->getResults()[0][0];
        return $results;
    }

    /**
    * count the number of commentary written by an user
    *
    * @param $pseudo : pseudo of the user searched
    *
    * @return void
    **/
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
