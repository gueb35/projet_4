<?php

require('controller/Frontend.php');
// require('controller/Backend.php');

define("PREFIXE", "115599");
define("SUFFIXE", "D5ZC4Z");

try{//on essaie de faire des choses
    if(isset($_GET['action'])){//si le paramètre "action" est présent ds l'url
        $action = $_GET['action'];
        switch($action)
        {
            case '':
                throw new Exception('C\'est pas bien de toucher aux paramètres de l\'URL !');
            break;

            case 'accessAdministrator':
                $backend = new alban\project_4\controller\Frontend();
                $backend->accessAdministrator();//envoie à la vue de la page d'identification de l'administrateur
            break;

            case 'identification':
                if(!empty($_POST['login']) && !empty($_POST['password'])){//vérifie si les champs ont bien été remplis
                    if(($_POST['login'] == 'Jean_Forteroche') && ((PREFIXE.hash("sha256",$_POST['password']).SUFFIXE) == '115599c17ac113230f5f31c4a53f58d0f24e8199dce328ae69acb0839e9cb224873a16D5ZC4Z')){//vérifie si le login et le password sont correct
                        $backend = new alban\project_4\controller\Frontend();
                        $backend->postsAdministrator();
                    }else{
                        throw new Exception('Le login ou le mot de passe sont incorrect !');
                    }
                }else{
                    throw new Exception('Vous n\'avez pas rempli tout les champs');
                }
            break;

            case 'sendText':
                if(!empty($_POST['content_post']) && !empty($_POST['title']))
                {
                    $backend = new alban\project_4\controller\Frontend();
                    $backend->sendText($_POST['content_post'], $_POST['title']);//envoie l'épisode en bdd
                }else{
                    throw new Exception('Il n\'y a pas de texte dans la zone de rédaction des épisode !');
                }
            break;

            case 'accessEpisodes':
                $frontend = new alban\project_4\controller\Frontend();
                $frontend->posts();
            break;

            case 'accessEpisode':
                if(isset($_GET['id']) && $_GET['id'] > '0')
                {
                    $frontend = new alban\project_4\controller\Frontend();
                    $frontend->post($_GET['id']);
                }else if(isset($_GET['id']) && $_GET['id'] == '')
                {
                    // Autre exception
                    throw new Exception('Il n\'y a pas encore d\'épisode suivant.Patience, ça arrive !');
                }else{
                    // Autre exception
                    throw new Exception('C\'est vraiment vraiment pas bien de toucher aux paramètres de l\'URL !');
                }
            break;

            case 'addComment':
                if(isset($_GET['id']) && $_GET['id'] > 0)
                {
                    if(!empty($_POST['author']) && !empty($_POST['comment']))
                    {
                        $author =  htmlspecialchars($_POST['author']);//permet de convertir les balises en caractères
                        $comment = htmlspecialchars($_POST['comment']);//permet de convertir les balises en caractères
                        $frontend = new alban\project_4\controller\Frontend();
                        $frontend->addComment($_GET['id'], $author, $comment);//appel au bon controller
                    }
                    else{
                        // Autre exception
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                }
                else{
                    // Autre exception
                    throw new Exception('Aucun identifiant de billet envoyé');
                }
            break;

            case 'moderateCommentView':
                $backend = new alban\project_4\controller\Frontend();
                $backend->accessModerateCommentView();
            break;

            case 'moderateComment':
                if(isset($_GET['id']) && $_GET['id'] > 0)
                {
                    $backend = new alban\project_4\controller\Frontend();
                    $backend->pushModerateComment($_GET['id']);
                }else{
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
                }
            break;

            case 'moderated':
                if(isset($_GET['id']) && $_GET['id'] > '0' && (isset($_GET['postId']) && $_GET['postId'] > '0'))
                {
                    $frontend = new alban\project_4\controller\Frontend();
                    $frontend->moderatedComment($_GET['id'], $_GET['postId']);
                    $frontend = new alban\project_4\controller\Frontend();
                    $frontend->post($_GET['postId']);
                }else{
                    // Autre exception
                    throw new Exception('Toucher aux paramètres de l\'URL c\'est pas gentil ! :-(');
                }
            break;

            case 'updateText':
                if(isset($_GET['id']) && $_GET['id'] > '0')
                {
                    $backend = new alban\project_4\controller\Frontend();
                    $backend->accessWysiwyg($_GET['id']);
                }else{
                    // Autre exception
                    throw new Exception('Toucher aux paramètres de l\'URL c\'est mal !');
                }
            break;

            case 'updatePost':
                if(isset($_GET['id']) && $_GET['id'] > '0')
                {
                    if(!empty($_POST['updateContent_post']) && !empty($_POST['updateTitle']))//permet de remplacer un épisode
                    {
                        if($_GET['id'] > '0'){
                            $backend = new alban\project_4\controller\Frontend();
                            $backend->updatepost($_GET['id'], $_POST['updateContent_post'], $_POST['updateTitle']);
                        }else{
                            throw new Exception('Le numéro de l\'épisode n\'est pas supérieur à 0 !');
                        }
                    }else{
                        throw new Exception('Vous n\'avez pas mis de texte de remplacement !');
                    }
                }else{
                    throw new Exception('Toucher aux paramètres de l\'URL c\'est vraiment mal !');
                }
            break;

            case 'deletePost':
                if(isset($_GET['id']) && $_GET['id'] > '0'){
                    $backend = new alban\project_4\controller\Frontend();
                    $backend->deletePost($_GET['id']);
                }else{
                    throw new Exception('Toucher aux paramètres de l\'URL c\'est vraiment très mal !');
                }
            break;

            default : throw new Exception('Le paramètre ne correspond à aucun des paramètres attendues !');
        }
    }
    else{
        $frontend = new alban\project_4\controller\Frontend();
        $frontend->showHomeView();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
    require('view/frontend/errorView.php');
}
?>