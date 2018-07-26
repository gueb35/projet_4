<?php $title = 'Bienvenue Mr Forteroche'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="text-center"> 
        <h1 class="titreWysiwyg">Que l'inspiration soit avec vous !</h1>
    
    </div>
        <div class="text-center">
            <input type="button" value="G" style="font-weight:bold;" onclick="commande('bold');" ></code>
            <input type="button" value="I" style="font-style:italic;" onclick="commande('italic');" ></code>
            <input type="button" value="S" style="text-decoration:underline;" onclick="commande('underline');" ></code>
            <select onchange="commande('heading', this.value); this.selectedIndex = 0;">
                <option value="">Titre</option>
                <option value="h1">Titre 1</option>
                <option value="h2">Titre 2</option>
                <option value="h3">Titre 3</option>
                <option value="h4">Titre 4</option>
                <option value="h5">Titre 5</option>
                <option value="h6">Titre 6</option>
            </select>
        </div>
        <div id="editeur" contentEditable ></div>

        <div class="container-fluid text-center"><input id="givehtml" type="button" onclick="resultat();" value="Obtenir le HTML" ></code><br /></div>
        
        <form action="./index.php?action=sendText" method="post">
            <textarea id="resultat" name="resultat"></textarea>
            <div class="text-center">
                <input type="submit" value="Envoyer votre épisode"/>
            </div>
        </form>
    

<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->

