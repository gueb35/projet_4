<?php $title = 'Bienvenue sur votre interface permettant la modération de commentaires !'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->


    <h2 class="titlemoderateComment">Tableau des commentaires signalés </h2>



    <div class="container">
        <table class="table table-hover">
            <tr>
                <th>Titre de l'épisode</th>
                <th>Nom</th>
                <th>Date</th>
                <th>Commentaire</th>
            </tr>
            <?php while ($comment = $commentsModerate->fetch())
            {
            ?>
            <tr>
                <td><?= $comment['titleComMod'] ?></td>
                <td><?= $comment['authorComMod'] ?></td>
                <td><?= $comment['creation_date_fr'] ?></td>
                <td><?= $comment['commentModerate'] ?></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    
<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->