<?php $title = 'Bienvenue sur votre interface permettant la modération de commentaires !'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->



    
<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->