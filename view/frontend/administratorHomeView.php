<?php $title = 'Bienvenue sur votre interface d\'administration Mr Forteroche !'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->


    <div class="title"> 
        <h1 class="titreWysiwyg">Que l'inspiration soit avec vous !</h1>
    </div>


    <div class="separationPostAdministrator"></div>

    <!-- CREATE -->
    <h3 class="text-center">Partie réservée à la création d'un nouvel épisode :</h3>
        <p class="text-center">Afin de créer un nouvel épisode, écrivez votre texte dans la zone prévu à cet effet,
        mettez-le forme puis cliquez sur le bouton "Envoyer votre épisode".
        </p> 
    <div class="create">
        <form action="./index.php?action=sendText" method="post">
            <textarea id="resultat" name="resultat">Ecrivez ici!</textarea>
            <div class="text-center">
                <input type="submit" value="Envoyer votre épisode"/>
            </div>
        </form>
    </div>

    <div class="readEpisodesPage">
        <?php
        while ($post = $posts->fetch())
        {
        ?>
            <div class="readEpisodesPagePost">
                <p><?= ($post['short_post']) ?><a href="index.php?action=accessEpisode&amp;id=<?= ($post['id']) ?>">...Lire la suite</a></p>
                <a href="index.php?action=updateText&amp;id=<?= ($post['id']) ?>">Modifier cet épisode !</a>
                <a href="index.php?action=deletePost&amp;id=<?= ($post['id']) ?>">Supprimer cet épisode !</a>
                <div class="separationPost"></div>
            </div>
        <?php
        }
        ?>
    </div>
    
<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->