
<?php

class Validation
{

    /**
    * clean a string
    *
    * @param $str : string to clean
    *
    * @return string : new string cleaned
    **/
    public static function cleanString(string $str)
    {

        return filter_var($str, FILTER_SANITIZE_STRING);
    }

    /**
    * check the validity of the connecting form
    *
    * @param $login : login renseigned in the form
    * @param $mot_de_passe : password renseigned in the form
    *
    * @return void
    **/
    public static function val_form_connexion(string &$login, string &$mot_de_passe)
    {
        $dVueErreur = array();
        if (!isset($login) || empty($login)) {
            $dVueErreur[] = "Votre nom d'utilisateur doit être renseigné";
            $login = "";
        }

        if ($login != filter_var($login, FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "tentative d'injection de code (attaque sécurité)";
            $login = "";
        }

        if (!isset($mot_de_passe) || empty($mot_de_passe)) {
            $dVueErreur[] = "Votre mot de passe doit être renseigné";
            $mot_de_passe = "";
        }

        if ($mot_de_passe != filter_var($mot_de_passe, FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "tentative d'injection de code (attaque sécurité)";
            $mot_de_passe = "";
        }
        return $dVueErreur;
    }

    /**
    * check the validity of the adding article form
    *
    * @param $titre : title renseigned in the form
    * @param $contenu : content renseigned in the form
    *
    * @return void
    **/
    public static function val_form_ajout_article(string &$titre, string &$contenu)
    {
        $dVueErreur = array();
        if (!isset($titre) || empty($titre)) {
            $dVueErreur[] = "Vous devez renseigné un titre";
            $titre = "";
        }

        if ($titre != filter_var($titre, FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "tentative d'injection de code (attaque sécurité)";
            $titre = "";
        }

        if (!isset($contenu) || empty($contenu)) {
            $dVueErreur[] = "Vous devez renseigné du contenu";
            $contenu = "";
        }

        if ($contenu != filter_var($contenu, FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "tentative d'injection de code (attaque sécurité)";
            $contenu = "";
        }
        return $dVueErreur;
    }
}

?>