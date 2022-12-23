<?php

require_once('modele/admin.php');

class Article
{
    private int $id;
    private DateTime $date;
    private string $titre;
    private string $contenu;
    private string $image;
    private int $nmbCommentaires;
    private Admin $redacteur;

    /**
    * generate a new article
    *
    * @param $id : id of the new article
    * @param $date : date of the new article
    * @param $titre : title of the new article
    * @param $contenu : content of the new article
    * @param $image : image of the new article
    * @param $nmbCommentaires : number of commentary of the new article
    * @param $redacteur : redactor of the new article
    *
    * @return void
    **/
    public function __construct(int $id, DateTime $date, string $titre, string $contenu, string $image, int $nmbCommentaires = 0, Admin $redacteur)
    {
        $this->id = $id;
        $this->date = $date;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->image = $image;
        $this->nmbCommentaires = $nmbCommentaires;
        $this->redacteur = $redacteur;
    }

    /**
    * get the id of the article
    *
    * @return int : id of the article
    **/
    public function __getId(): int
    {
        return $this->id;
    }

    /**
    * get the date of the article
    *
    * @return DateTime : date of the article
    **/
    public function __getDate(): DateTime
    {
        return $this->date;
    }

    /**
    * get the title of the article
    *
    * @return string : title of the article
    **/
    public function __getTitre(): string
    {
        return $this->titre;
    }

    /**
    * get the content of the article 
    *
    * @return string : content of the article
    **/
    public function __getContenu(): string
    {
        return $this->contenu;
    }

    /**
    * get the image of the article
    *
    * @return string : image of the article
    **/
    public function __getImage(): string
    {
        return $this->image;
    }

    /**
    * get the number of commentary written under an article
    *
    * @return int : number of commentary of an article
    **/
    public function __getNmbCommentaires(): int
    {
        return $this->nmbCommentaires;
    }

    /**
    * get the redactor of the article
    *
    * @return Admin : admin who has written the article
    **/
    public function __getRedacteur(): Admin
    {
        return $this->redacteur;
    }

    /**
    * set the number of commentary written under an article
    *
    * @param $nmb : number of commentary given to define the number of commentary under
    * an article
    *
    * @return int : number of commentary of an article
    **/
    public function __setNmbCommentaires($nmb): int
    {
        return $this->nmbCommentaires = $nmb;
    }
}
