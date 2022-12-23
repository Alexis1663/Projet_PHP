<?php

class Admin
{
    private string $pseudo;
    private string $motDePasse;
    private int $nmbCommentairesEcrits;
    private int $nmbArticlesEcrits;

    /**
    * generate the admin’s constructor
    *
    * @param $nmbArticlesEcrits : number of article written by the admin
    *
    * @return void
    **/
    public function __construct(string $pseudo, string $motDePasse, int $nmbCommentairesEcrits = 0, int $nmbArticlesEcrits = 0)
    {
        $this->pseudo = $pseudo;
        $this->motDePasse = $motDePasse;
        $this->nmbArticlesEcrits = $nmbArticlesEcrits;
        $this->nmbCommentairesEcrits = $nmbArticlesEcrits;
    }

    /**
    * get the pseudo of the admin
    *
    * @return string : pseudo of the admin
    **/
    public function __getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
    * get the number of commentary written by an admin
    *
    * @return int : number of commentary written by an admin
    **/
    public function __getNmbCommentaireEcrits(): string
    {
        return $this->nmbCommentairesEcrits;
    }

    /**
    * get the number of article written by an admin
    *
    * @return int : number of article written
    **/
    public function __getNmbArticlesEcrits(): int
    {
        return $this->nmbArticlesEcrits;
    }
}
