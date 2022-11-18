<?php

//chargement config
require_once(__DIR__.'/config/config.php');

//chargement autoloader pour autochargement des classes
require_once(__DIR__.'/config/autoload.php');
Autoload::charger();

require_once(__DIR__.'/controleur/frontControleur.php');

$cont = new FrontControleur();
$cont->frontRequest();

?> 