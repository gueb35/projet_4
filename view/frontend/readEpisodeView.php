<?php $title = 'Bienvenue sur la page de lecture des épisodes !'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="text-center"> 
        <h1>Bonne lecture!</h1>
    </div>

    <div class="row">
        <div class="episode1andmore col-md-offset-1 col-md-5">
            <p>
                <?= htmlspecialchars($post['resultat']) ?>
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
        </div>
    </div>

<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->

<!-- <div class="news">
    <h3>
        <?= htmlspecialchars($post['title']) ?>
        <em>le <?= $post['creation_date_fr'] ?></em>
    </h3>
    
    <p>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </p>
</div> -->