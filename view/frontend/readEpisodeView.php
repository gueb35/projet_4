<?php $title = 'Bienvenue sur la page de lecture des épisodes !'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="title"> 
        <h1>Bonne lecture!</h1>
    </div>

    <div class="readEpisodePage row">
        <div class="episode1andmore col-xs-offset-1 col-xs-11 col-sm-offset-1 col-sm-6 col-md-offset-1 col-md-5">
            <p>
                <?= ($post['resultat']) ?>
            </p>
            <a href="index.php?action=accessEpisode&amp;id=<?= $previousPostId ?>">épisode précédent</a>
            <a href="index.php?action=accessEpisode&amp;id=<?= $nextPostId ?>">épisode suivant</a>
        </div>
        <div class="col-xs-offset-1 col-xs-11 col-sm-offset-1 col-sm-4 col-md-offset-1 col-md-3">
            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <p class="whiteFont"><strong>N'oubliez pas de poster votre commentaire !</strong></p>
                    <div>
                        <label class="whiteFont" for="author">Auteur</label><br />
                        <input type="text" id="author" name="author" />
                    </div>
                    <div>
                        <label class="whiteFont" for="comment">Commentaire</label><br />
                        <textarea id="comment" name="comment"></textarea>
                    </div>
                    <div>
                        <input type="submit" />
                    </div>
            </form>

            <h2 class="whiteFont">Commentaires</h2>

            <?php
            while ($comment = $comments->fetch())
            {
            ?>
                <p class="whiteFont"><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['creation_date_fr'] ?></p>
                <p class="whiteFont"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <?php
            }
            ?>
        </div>
    </div>


<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->