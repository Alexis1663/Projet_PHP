<?php

class User
{
	private string $pseudo;
	private string $nom;
	private string $prenom;
	private string $motDePasse;
	private int $nmbCommentairesEcrits;

	public function __construct(string $pseudo, string $nom, string $prenom, string $motDePasse, int $nmbCommentairesEcrits=0){
		$this->pseudo=$pseudo;
		$this->nom=$nom;
		$this->prenom=$prenom;
		$this->motDePasse=$motDePasse;
		$this->nmbCommentairesEcrits=$nmbCommentairesEcrits;
	}

	public function __getPseudo():string{
		return $this->pseudo;
	}

	public function __getNom():string{
		return $this->nom;
	}

	public function __getPrenom():string{
		return $this->prenom;
	}

	public function __getMotDePasse():string{
		return $this->motDePasse;
	}

	public function __getNmbCommentairesEcrits():int{
		return $this->nmbCommentairesEcrits;
	}

	public function __setNmbCommentairesEcrits($nmb):int{
		return $this->nmbCommentairesEcrits=$nmb;
	}

}

?>