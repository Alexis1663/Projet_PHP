<?php

class AdminGateway
{

    private $con;

    /**
     * generate the admin gateway constructor
     *
     * @param $con : connection's parameters

     *
     * @return void
     */
    public    function __construct(Connection    $con)
    {
        $this->con = $con;
    }


    /**
     *  get the id of the article
     *
     * @param $pseudo : pseudo of the admin searched
     *
     * @return string : password of an admin searched
     */
    public function getCredential(string $pseudo)
    {
        $queryCredentials = "SELECT motDePasse FROM admin WHERE pseudo=:pseudo";
        $this->con->executeQuery($queryCredentials, array(
            ":pseudo" => array($pseudo, PDO::PARAM_STR)
        ));
        return $this->con->getResults();
    }



    /**
     *  get the information of and admin
     *
     * @param $pseudo : pseudo of the admin searched
     *
     * @return array : name, surname and number of article written by an admin
     */
    public function getInformationAdmin(string $pseudo): array
    {
        $queryCredentials = "SELECT nom,prenom,nmbArticlesEcrits FROM Admin WHERE pseudo=:pseudo";
        if ($this->con->executeQuery($queryCredentials, array(":pseudo" => array($pseudo, PDO::PARAM_STR)))) {
            return $this->con->getResults()[0];
        } else {
            throw new PDOException("ERR : GetInformationAdmin !");
        }
    }
}
