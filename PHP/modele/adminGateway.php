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
}
