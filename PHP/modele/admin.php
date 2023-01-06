<?php

class Admin
{
    private string $pseudo;
    private string $motDePasse;
    private int $nmbCommentairesEcrits;
    private int $nmbArticlesEcrits;

    public function __construct(string $pseudo, string $motDePasse, int $nmbCommentairesEcrits = 0, int $nmbArticlesEcrits = 0)
    {
        $this->pseudo = $pseudo;
        $this->motDePasse = $motDePasse;
        $this->nmbArticlesEcrits = $nmbArticlesEcrits;
        $this->nmbCommentairesEcrits = $nmbArticlesEcrits;
    }

    public function __getPseudo(): string
    {
        return $this->pseudo;
    }

    public function __getNmbCommentaireEcrits(): string
    {
        return $this->nmbCommentairesEcrits;
    }

    public function __getNmbArticlesEcrits(): int
    {
        return $this->nmbArticlesEcrits;
    }
}
