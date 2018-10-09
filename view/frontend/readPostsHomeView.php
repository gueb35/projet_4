<?php $title = 'Bienvenue sur la page des épisodes !'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="title">
        <h1>Choisissez l'épisode qui vous intéresse !</h1>
    </div>

    <div class="readEpisodesPage">
        <?php
        while ($post = $posts->fetch())
        {
        ?>
            <p><?= ($post['title']) ?>
            <p><?= ($post['short_post']) ?><a href="index.php?action=accessPost&amp;id=<?= ($post['id']) ?>">...Lire la suite</a></p>
            <div class="separationPost"></div>
        <?php
        }
        ?>
    </div>

<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('templateUser.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->