<?php $title = 'Bienvenue sur votre interface permettant la modération de commentaires !'; ?><!--définit le titre de la page-->

    <?php ob_start(); ?><!--définit le contenu de la page-->

        <div class="titlemoderateComment">
            <h2 class="titlemoderate">Tableau des commentaires signalés </h2>
        </div>


        <div class="container">
            <table class="table table-hover">
                <tr>
                    <th>Titre de l'épisode</th>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Commentaire</th>
                    <th>Modéré le commentaire</th>
                    <th>Mode du commentaire</th>
                </tr>
                <?php while ($comment = $commentsModerate->fetch())
                {
                ?>
                <tr>
                    <td><?= $comment['titleComMod'] ?></td>
                    <td><?= $comment['authorComMod'] ?></td>
                    <td><?= $comment['creation_date_fr'] ?></td>
                    <td><?= $comment['commentModerate'] ?></td>
                    <td><a href="index.php?action=moderateComment&amp;id=<?= ($comment['idComMod']) ?>" class="linkModCom">Modérer !</a></td>
                    <td><?= $comment['comMod'] ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>

    <?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('templateAdmin.php'); ?>