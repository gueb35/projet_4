<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="./public/css/style.css"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <script src="public/js/tinymce/tinymce.min.js"></script>
        <script>
            tinymce.init({
                selector: '#title',
                language: 'fr_FR',
                language_url: 'public/js/tinymce/langs/fr_FR.js'
            });
        </script>       
        <script>
            tinymce.init({
                selector: '#updateTitle',
                language: 'fr_FR',
                language_url: 'public/js/tinymce/langs/fr_FR.js'
            });
        </script> 
        <script>
            tinymce.init({
                selector: '#resultat',
                language: 'fr_FR',
                language_url: 'public/js/tinymce/langs/fr_FR.js'
            });
        </script>
        <script>
            tinymce.init({
                selector: '#updateResultat',
                language: 'fr_FR',
                language_url: 'public/js/tinymce/langs/fr_FR.js'
            });
        </script>
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Accueil</a></li>
                        <li><a href="index.php?action=accessAdministrator">Espace administrateur</a></li>
                        <li><a href="index.php?action=accessEpisodes">Espace lecture</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <?= $content ?>    
    </body>
</html>