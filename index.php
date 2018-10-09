<?php

session_start();
    // require 'Autoloader.php';
    // Autoloader::register();
require('routeur/Routeur.php');

$routeur = new alban\project_4\routeur\Routeur();
$routeur->routeur();
?>