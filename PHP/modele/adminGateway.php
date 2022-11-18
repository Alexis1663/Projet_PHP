<?php

include 'user.php';
include 'connection.php';

class AdminGateway{

	private $con;

	/**
	 * generate
	 *
	 * @param $con 
	 *
	 * @return void
	*/
	public	function __construct(Connection	$con){	 
		$this->con=$con;
	}

	/**
	 * add an user in the database
	 *
	 * @param $pseudo : primary key of an user
	 * @param $nom : name of an user 
	 * @param $prenom : surname of an user
	 * @param $motDePasse : user's password
	 * @param $nmbCommentairesEcrits : number of commentary written by the user
	 * 
	 * @return void
	**/
	public function addU(string $pseudo, string $nom, string $prenom, string $motDePasse, int $nmbCommentairesEcrits){
		$queryadd = "INSERT INTO User VALUES (:pseudo,:nom,:prenom,:motDePasse,:nmbCommentairesEcrits)";
		$this->con->executeQuery($queryadd, array(':pseudo'=>array($pseudo,PDO::PARAM_STR), ':nom'=>array($nom,PDO::PARAM_STR), 'prenom'=>array($prenom,PDO::PARAM_STR), 'motDePasse'=>array($motDePasse,PDO::PARAM_STR), 'nmbCommentairesEcrits'=>array($nmbCommentairesEcrits,PDO::PARAM_STR) ));
	}

	/**
	 * delete an user
	 *
	 * @param $pseudo : primary key of an user
	 *
	 * @return void
	**/
	public function deleteU(int $pseudo){
		$querydelete = "DELETE FROM User WHERE pseudo=:pseudo";
		$this->con->executeQuery($querydelete, array(':pseudo'=>array($pseudo,PDO::PARAM_STR) ));
	}
}

?>