<?php
    //Détruit la session
	$_SESSION = array();
	session_destroy();
	header('location:index.php');
?>