<?php $title = 'Bienvenue Mr Forteroche'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="text-center"> 
        <h1 class="titreWysiwyg">Que l'inspiration soit avec vous !</h1>
    </div>

    <div class="separation"></div>
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

    <div class="separation"></div>
    <h3 class="text-center">Partie réservée au remplacement d'un épisode :</h3>
        <p class="text-center">Afin de remplacer un épisode, récupérer le numéro situé en bas de page sur l'espace lecture, 
        puis rentrez ce numéro dans le champ id.
        Ensuite, écrivez votre texte dans la zone prévu à cet effet,
        mettez-le forme puis cliquez sur le bouton "Envoyer".
        </p>

    <div class="update">
    
    </div>

    <div class="separation"></div>
    <h3 class="text-center">Partie réservée à la suppression d'un épisode :</h3>
        <p class="text-center">Afin de supprimer un épisode, récupérer le numéro situé en bas de page sur l'espace lecture, 
        puis rentrez ce numéro dans le champ ci-dessous.<br/>Ensuite, cliquez sur le bouton "Supprimer".
        </p>

    <div class="delete text-center">
        <form action="./index.php?action=deletePost" method="post">
            <label for="postNumber">Numéro de l'épisode :</label><br/>
            <input type="number" id="postNumber" name="postNumber" placeholder="Ecrire ici le numéro !"/><br/>
            <input type="submit" value="Supprimer"/>
        </form>

    </div>


<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->

