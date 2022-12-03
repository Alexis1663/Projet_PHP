<?php

include 'admin.php';

class Article
{
	private int $id;
	private DateTime $date;
	private string $titre;
	private string $contenu;
	private string $image;
	private int $nmbCommentaires;
	private Admin $redacteur;

	public function __construct(int $id, DateTime $date, string $titre, string $contenu, string $image, int $nmbCommentaires=0, Admin $redacteur){
		$this->id=$id;
		$this->date=$date;
		$this->titre=$titre;
		$this->contenu=$contenu;
		$this->image=$image;
		$this->nmbCommentaires=$nmbCommentaires;
		$this->redacteur=$redacteur;
	}

	public function __getId():int{
		return $this->id;
	}

	public function __getDate():DateTime{
		return $this->date;
	}

	public function __getTitre():string{
		return $this->titre;
	}

	public function __getContenu():string{
		return $this->contenu;
	}

	public function __getImage():string{
		return $this->image;
	}

	public function __getNmbCommentaires():int{
		return $this->nmbCommentaires;
	}

	public function __getRedacteur():Admin{
		return $this->redacteur;
	}

	public function __setNmbCommentaires($nmb):int{
		return $this->nmbCommentaires=$nmb;
	}

}

?>