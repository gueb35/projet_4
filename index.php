<?php

session_start();
    // require 'Autoloader.php';
    // Autoloader::register();
require('controller/Routeur.php');

$routeur = new alban\project_4\controller\Routeur();
$routeur->routeur();
?>