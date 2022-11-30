<?php

include 'user.php';
include 'connection.php';

class UserGateway{

	public	function __construct(Connection	$con){	 
		$this->con=$con;
	}

	public function connexionUser($pseudo, $motDePasse){

        $_SESSION['role']='user';
        $_SESSION['login']=$login;
        session_start();
    }

    public function deconnexionUser(){
        session_unset();
        session_destroy();
        $_SESSION=array();
    }



}