<?php

class AdminGateway
{

    private $con;

    /**
     * generate
     *
     * @param $con 
     *
     * @return void
     */
    public    function __construct(Connection    $con)
    {
        $this->con = $con;
    }

    public function getCredential(string $pseudo)
    {
        $queryCredentials = "SELECT motDePasse FROM admin WHERE pseudo=:pseudo";
        $this->con->executeQuery($queryCredentials, array(
            ":pseudo" => array($pseudo, PDO::PARAM_STR)
        ));
        return $this->con->getResults();
    }

    public function getInformationAdmin(string $pseudo): array
    {
        $queryCredentials = "SELECT nom,prenom,nmbArticlesEcrits FROM Admin WHERE pseudo=:pseudo";
        if ($this->con->executeQuery($queryCredentials, array(":pseudo" => array($pseudo, PDO::PARAM_STR)))) {
            return $this->con->getResults()[0];
        } else {
            throw new PDOException("ERR : GetInformationAdmin !");
        }
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
}
