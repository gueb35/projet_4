<?php $title = 'Bienvenue Mr Forteroche'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="text-center"> 
        <h1>Identification de l'administrateur</h1>
    
    <form action="index.php?action=identification&amp;id=<?= $post['id'] ?>" method="post">
        <div>
            <label for="pseudo">Pseudo :</label><br />
            <input type="text" id="pseudo" name="pseudo" />
        </div>
        <div>
            <label for="mdp">Mot de passe :</label><br />
            <input type="password" id="mdp" name="mdp"/>
        </div>
        <div class="boutonAccesWysiwyg">
            <input type="submit" value="Accéder à votre interface d'écriture"/>
        </div>
    </form>

<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->