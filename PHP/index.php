<?php

//chargement config
require_once(__DIR__.'/config/config.php');

//chargement autoloader pour autochargement des classes
require_once(__DIR__.'/config/autoload.php');
Autoload::charger();

require_once(__DIR__.'/controleur/frontControleur.php');

$cont = new FrontControleur();
//$cont->frontRequest();

if(isset($_GET['page'])){
    $page = $_GET['page'];
    switch($page){
        case "accueil":
            require($vue['accueil']);
            break;
        case "inscription":
            require($vue['inscription']);
            break;
        case "connexion":
            require($vue['connexion']);
            break;
        case "article":
            require($vue['article']);
    }
}
else{
    require($vue['accueil']);
}

?> 