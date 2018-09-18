<?php $title = 'Bienvenue sur votre interface permettant la modération de commentaires !'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->


    <h2 class="titlemoderateComment">Tableau des commentaires signalés </h2>

    <?php
    while ($comment = $commentsModerate->fetch())
    {
    ?>
        <p class="whiteFont"><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['creation_date_fr'] ?></p>
        <p class="whiteFont"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        <a href="index.php?action=moderated&amp;id=<?= $comment['id'] ?>&amp;postId=<?= $post['id'] ?>">Modéré ce commentaire !</a>
    <?php
    }
    ?>
    
<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->