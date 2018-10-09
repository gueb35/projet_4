<?php $title = 'Bienvenue sur la page d\'accueil !'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="title">
        <h1>Bienvenue sur mon site!</h1>

    <p>Pour ce nouveau roman, j'ai décidé de vous le faire découvrir par épisode directement sur ce site.<br/></p>
    <p>Afin d'être plus proche de vous, vous pourrez commenter chaque épisode alors, n'hésitez pas, donnez vos impressions!!</p>
    </div>

    <div class="episode text-center">
        <h2 class="titreDuLivre">Billet simple pour l'alaska</h2>
        <p class="auteur_couverture"><strong>Auteur :</strong></p>
        <p>Jean Forteroche</p>
    </div>


<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('templateUser.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->