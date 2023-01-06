
<?php

require_once('modele/adminGateway.php');
require_once('modele/admin.php');
require_once('modele/validation.php');
require_once('modele/connection.php');

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

    public function addArticle()
    {
        global $dns, $user, $password;

        $adminG = new AdminGateway(new Connection($dns, $user, $password));
        $dVueErreur = array();
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $extensionUpload = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
            $chemin = "vue/img/" . date('Y-m-d') . "_" . $_REQUEST['titre'] . "." . $extensionUpload;
            $move = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
            if ($move) {
                $dVueErreur[] = $adminG->addA(date('Y-m-d'), $_REQUEST['titre'], $_REQUEST['contenu'], date('Y-m-d') . "_" . $_REQUEST['titre'] . "." . $extensionUpload, 0);
                header('Location: index.php');
            } else {
                $dVueErreur[] = "pb inportation fichier";
                return $dVueErreur;
            }
        }

        return $dVueErreur;
    }

    public function deleteArticle(string $date, string $titre)
    {
        global $dns, $user, $password;

        $adminG = new AdminGateway(new Connection($dns, $user, $password));
        $dVueErreur = array();
        $adminG->deleteA($date, $titre);
        return $dVueErreur;
    }
}

?>