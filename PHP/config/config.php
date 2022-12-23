<?php

//Generation of variable
$rep = __DIR__ . '/../';


//Database's informations : to be adapted according your logins

//$user = "lobroda";
//$password = "achanger";
//$dns = "mysql:host=localhost;dbname=dblobroda";


$user = "root";
$password = "Root-linux63";
$dns = "mysql:host=localhost;dbname=projet_php";


//Generation of all views


$vue['erreur'] = 'vue/html/erreur.php';
$vue['accueil'] = 'vue/html/accueil.php';
$vue['connexion'] = 'vue/html/connexion.php';
$vue['article'] = 'vue/html/article.php';
$vue['ajoutArticle'] = 'vue/html/ajoutArticle.php';
$vue['commenter'] = 'vue/html/ajoutCommentaire.php';
