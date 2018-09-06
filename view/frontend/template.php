<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="../public/css/style.css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <script src="../public/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
                selector: '#resultat',
                language: 'fr_FR',
                language_url: '../public/js/tinymce/langs/fr_FR.js'
            });
        </script>
        <script type="text/javascript">
            tinymce.init({
                selector: '#updateResultat',
                language: 'fr_FR',
                language_url: '../public/js/tinymce/langs/fr_FR.js'
            });
        </script>
    </head>
        
    <body>
        <div class="container">
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="../view/index.php">Accueil</a></li>
                        <li><a href="../view/index.php?action=accessAdministrator">Espace administrateur</a></li>
                        <li><a href="../view/index.php?action=accessEpisode&amp;id=1">Espace lecture</a></li><!--définir l'id à 1 
                        pour avoir avoir l'épisode 1 de base en arrivant sur la vue readEpisodeView.php, crée 2 boutons sous la
                         zone de lecture ("épisode suivant", et "épisode précédent") qui incrémente ou décrémente de 1 l'id-->
                    </ul>
                </div>
        </div>

        <?= $content ?>    
    </body>
</html>
