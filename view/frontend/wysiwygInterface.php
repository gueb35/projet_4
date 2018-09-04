<?php $title = 'Bienvenue Mr Forteroche'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="text-center"> 
        <h1 class="titreWysiwyg">Que l'inspiration soit avec vous !</h1>
    </div>

    <div class="separation"></div>
    <h3 class="text-center">Partie réservée à la création d'un nouvel épisode :</h3>

    <div class="create">
        <form action="./index.php?action=sendText" method="post">
            <textarea id="resultat" name="resultat"></textarea>
            <div class="text-center">
                <input type="submit" value="Envoyer votre épisode"/>
            </div>
        </form>
    </div>

    <div class="separation"></div>
    <h3 class="text-center">Partie réservée au remplacement d'un épisode :</h3>

    <div class="update">
    
    </div>

    <div class="separation"></div>
    <h3 class="text-center">Partie réservée à la suppression d'un épisode :</h3>

    <div class="delete">

    </div>


<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->

