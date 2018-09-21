<?php $title = 'Page d\'identification'; ?><!--définit le titre de la page, celui-ci sera inséré ds la balise title ds le template-->
<?php ob_start(); ?><!--définit le contenu de la page, ob_start mémorise toute la sortie html-->

    <div class="title"> 
        <h1>Identification de l'administrateur</h1>

    
        <form action="./index.php?action=identification" method="post">
            <div>
                <label for="login">Pseudo :</label><br />
                <input type="password" id="login" name="login" autocomplete="off" />
            </div>
            <div>
                <label for="password">Mot de passe :</label><br />
                <input type="password" id="password" name="password"/>
            </div>
            <div class="boutonAccesWysiwyg">
                <input type="submit" value="Accéder à votre interface d'écriture"/>
            </div>
        </form>
        <p class="redFont">Pour des raisons de sécurité, veuillez ne jamais autoriser la mémorisation de votre identifiant et mot de passe !<p>

    </div>

<?php $content = ob_get_clean(); ?><!--récupère le contenu généré et met tout ds $content-->

<?php require('view/template.php'); ?><!--appelle le template pour récupérer les variables $title et $content-->