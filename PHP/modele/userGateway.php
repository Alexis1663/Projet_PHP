<?php

include 'user.php';
include 'connection.php';

class UserGateway{

	public	function __construct(Connection	$con){	 
		$this->con=$con;
	}

	public function connexionUser($pseudo, $motDePasse){
        session_start();
        
        $_SESSION['role']='user';
        $_SESSION['login']=$login;
        
    }

    public function deconnexionU(){
        session_unset();
        session_destroy();
        $_SESSION=array();
    }



}