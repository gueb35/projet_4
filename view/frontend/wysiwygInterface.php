<?php $title = 'Bienvenue Mr Forteroche'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="text-center"> 
        <h1 class="titreWysiwyg">Que l'inspiration soit avec vous !</h1>
    
    </div>

<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->