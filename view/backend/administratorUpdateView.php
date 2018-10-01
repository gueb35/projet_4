<?php $title = 'Remplacer ou modifier un épisode !'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="title"> 
        <h1 class="titreWysiwyg">Que l'inspiration soit avec vous !</h1>
    </div>

    <div class="separation"></div>

<!-- UPDATE -->
    <h3 class="text-center">Partie réservée au remplacement ou à la modification d'un épisode :</h3>
        <p class="text-center">
            Pour ce faire, écrivez ou modifiez votre titre et votre texte dans les zones prévues à ces effets,
            mettez-les forme puis cliquez sur le bouton "Modifiez votre épisode".
        </p>
    <div class="update">
            <form action="./index.php?action=updatePost&amp;id=<?= ($post['id']) ?>" method="post">
                <textarea id="updateTitle" name="updateTitle"><?= $post['title'] ?></textarea>
                <textarea id="updateContent_post" name="updateContent_post"><?= $post['content_post'] ?></textarea>
                <div class="text-center">
                    <input type="submit" value="Modifiez votre épisode"/>
                </div>
            </form>
    </div>



<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('view/template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->

