<?php $title = 'Bienvenue sur la page de lecture des épisodes !'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="text-center"> 
        <h1>Bonne lecture!</h1>
    </div>

    <div class="readEpisodePage row">
        <div class="episode1andmore col-md-offset-1 col-md-5">
            <p>
                <?= ($post['resultat']) ?>
            </p>
            <p> 
                <?= ($post['id']) ?>
            </p>
        </div>
        <div class="col-md-offset-1 col-md-3">
            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <p><strong>N'oubliez pas de poster votre commentaire !</strong></p>
                    <div>
                        <label for="author">Auteur</label><br />
                        <input type="text" id="author" name="author" />
                    </div>
                    <div>
                        <label for="comment">Commentaire</label><br />
                        <textarea id="comment" name="comment"></textarea>
                    </div>
                    <div>
                        <input type="submit" />
                    </div>
            </form>
            <form action="index.php?action=accessEpisodeInferior&amp;id=<?= $post['id'] ?>" method="post">
                <input type="submit" value="épisode précédent"/>
            </form>
            <form action="index.php?action=accessEpisodeSuperior&amp;id=<?= $post['id'] ?>" method="post">
                <input type="submit" value="épisode suivant"/>
            </form>
        </div>
    </div>


    <h2>Commentaires</h2>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['creation_date_fr'] ?></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <?php
    }
    ?>

<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->