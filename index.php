<?php

session_start();

use \alban\projet_4\Autoloader;
use \alban\projet_4\routeur\Routeur;

require 'Autoloader.php';
Autoloader::register();

$routeur = new Routeur();
$routeur->routeur();
?>