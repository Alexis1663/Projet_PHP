
<?php

class Validation
{
    public static function cleanString(string $str)
    {

        return filter_var($str, FILTER_SANITIZE_STRING);
    }

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

    public static function val_form_ajout_commentaire(string &$titre, string &$contenu, string &$pseudo)
    {
        $dVueErreur = array();

        if (!isset($pseudo) || empty($pseudo)) {
            $dVueErreur[] = "Vous devez renseigné votre pseudo";
            $pseudo = "";
        }

        if ($pseudo != filter_var($pseudo, FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "tentative d'injection de code (attaque sécurité)";
            $pseudo = "";
        }

        if (!isset($titre) || empty($titre)) {
            $dVueErreur[] = "Vous devez renseigné un titre au commentaire";
            $titre = "";
        }

        if ($titre != filter_var($titre, FILTER_SANITIZE_STRING)) {
            $dVueErreur[] = "tentative d'injection de code (attaque sécurité)";
            $titre = "";
        }

        if (!isset($contenu) || empty($contenu)) {
            $dVueErreur[] = "Vous devez renseigné du contenu à votre commentaire";
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