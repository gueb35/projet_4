<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="../../public/css/style.css" /> 
        <link rel="stylesheet" href="../public/css/style.css" />
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <script src="../public/js/editeur.js"></script>
    </head>
        
    <body>
        <div class="container">
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container-fluid">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="homeView.php">Accueil</a></li>
                        <li><a href="administratorAccessView.php">Espace administrateur</a></li>
                    </ul>
                </div>
        </div>

        <?= $content ?>    
    </body>
</html>