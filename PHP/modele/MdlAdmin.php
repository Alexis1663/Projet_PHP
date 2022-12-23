
<?php

require_once('modele/adminGateway.php');
require_once('modele/admin.php');
require_once('modele/validation.php');

class MdlAdmin
{
    public function connexion($login, $mdp)
    {
        global $dns, $user, $password;

        $adminG = new AdminGateway(new Connection($dns, $user, $password));
        $dVueErreur = array();
        $login = Validation::cleanString($login);
        $mdp = Validation::cleanString($mdp);
        $dVueErreur = Validation::val_form_connexion($login, $mdp);
        if (empty($dVueErreur)) {
            if ($adminG->getCredential($login) != null) {
                if (password_verify($mdp, $adminG->getCredential($login)[0]['motDePasse'])) {
                    $_SESSION['role'] = "admin";
                    $_SESSION['login'] = $login;
                    return new Admin($login, $mdp);
                } else {
                    $dVueErreur[] = "Mot de passe incorrect";
                    return $dVueErreur;
                }
            } else {
                $dVueErreur[] = "Login ou mot de passe incorrect";
                return $dVueErreur;
            }
        } else {
            return $dVueErreur;
        }
    }


    public function deconnexion()
    {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }

    public static function isAdmin()
    {
        global $dns, $user, $password;
        //teste	rôle	dans	la	session,	retourne	instance	d’objet	ou	booleen	
        if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
            $login = Validation::cleanString($_SESSION['login']);
            $role = Validation::cleanString($_SESSION['role']);
            return new Admin($login, $role);
        } else {
            return null;
        }
    }
}

?>