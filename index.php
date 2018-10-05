<?php

session_start();

require('controller/Routeur.php');

$routeur = new alban\project_4\controller\Routeur();
$routeur->routeur();
?>