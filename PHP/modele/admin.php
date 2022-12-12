<?php

include_once ('user.php');

class Admin extends User
{
	private string $pseudo;
	private string $nom;
	private string $prenom;
	private string $motDePasse;	
	private int $nmbCommentairesEcrits;
	private int $nmbArticlesEcrits;

	public function __construct(int $nmbArticlesEcrits=0){
		parent::__construct($this->pseudo, $this->nom, $this->prenom, $this->motDePasse, $this->nmbCommentairesEcrits=0);
		$this->nmbArticlesEcrits=$nmbArticlesEcrits;
	}

	public function __getNmbArticlesEcrits():int{
		return $this->nmbArticlesEcrits;
	}	

	public function __setNmbCommentairesEcrits($nmb):int{
		return $this->nmbCommentairesEcrits=$nmb;
	}
}

?>