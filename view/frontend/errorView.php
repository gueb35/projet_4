<?php ob_start(); ?>

    <?=  'La connexion à la base de données à échouée, vérifiez la réquete de connexion à la base de données.Un erreur d\'orthographe est vite arrivée !' ?> 

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>