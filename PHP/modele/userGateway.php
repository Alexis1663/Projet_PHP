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

    public function getCredential(string $pseudo):string{
		$queryCredentials = "SELECT motDePasse FROM User WHERE pseudo=:pseudo";
		if($this->con->executeQuery($queryCredentials, array(":login"=>array($pseudo,PDO::PARAM_STR)))){
			return ($this->con->getResults()[0]['motDePasse']);
		}
		else{
			throw new PDOException("ERR : GetCredential !");
		}
	}

}

?>

