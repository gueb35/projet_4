<?php $title = 'Page d\'erreur !'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->

<?php ob_start(); ?>

<div class="errorMessage title">
    <!-- <?=  'La connexion à la base de données à échouée, vérifiez la réquete de connexion à la base de données.Un erreur d\'orthographe est vite arrivée !' ?>  -->
    <?=  'Erreur : ' . $e->getMessage(); ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>