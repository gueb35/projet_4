<!--création du routeur
l'ensemble de ces conditions permet d'appeler le bon controleur-->
<?php define("PREFIXE", "115599"); ?>
<?php define("SUFFIXE", "D5ZC4Z"); ?>
<?php

require('controller/frontend.php');//permet d'avoir accès

try{//on essaie de faire des choses
    if(isset($_GET['action'])){//si le paramètre "action" est présent ds l'url
        if($_GET['action'] == ''){
            throw new Exception('C\'est pas bien de toucher aux paramètres de l\'URL !');
        }


        else if($_GET['action'] == 'accessAdministrator'){
            accessAdministrator();//envoie à la vue de la page d'identification de l'administrateur
        }
        

        else if($_GET['action'] == 'identification'){//si le paramètre "action" présent ds l'url est identification
            if(!empty($_POST['login']) && !empty($_POST['password'])){//vérifie si les champs ont bien été remplis
                if(($_POST['login'] == 'Jean_Forteroche') && ((PREFIXE.hash("sha256",$_POST['password']).SUFFIXE) == '115599c17ac113230f5f31c4a53f58d0f24e8199dce328ae69acb0839e9cb224873a16D5ZC4Z')){//vérifie si le login et le password sont correct
                    postsAdministrator();
                }else{
                    throw new Exception('Le login ou le mot de passe sont incorrect !');
                }
            }else{
                throw new Exception('Vous n\'avez pas rempli tout les champs');
            }
        } 

        //envoie le titre et le texte en bdd
        else if($_GET['action'] == 'sendText'){
            if(!empty($_POST['resultat']) && !empty($_POST['title'])){
                sendText($_POST['resultat'], $_POST['title']);//envoie l'épisode en bdd
            }else{
                throw new Exception('Il n\'y a pas de texte dans la zone de rédaction des épisode !');
            }
        }


        //accède aux épisodes depuis le lien du menu de navigation(accès de base)
        else if($_GET['action'] == 'accessEpisodes'){
                posts();  
        }


        //accède à un épisode et envoie à la vue ou on peut lire l'épisode
        else if($_GET['action'] == 'accessEpisode'){
            if(isset($_GET['id']) && $_GET['id'] > '0'){  
                post($_GET['id']);
            }else if(isset($_GET['id']) && $_GET['id'] == ''){
                // Autre exception
                throw new Exception('Il n\'y a pas encore d\'épisode suivant.Patience, ça arrive !');
            }else{
                // Autre exception
                throw new Exception('C\'est vraiment vraiment pas bien de toucher aux paramètres de l\'URL !');
            }
        }


        else if (($_GET['action'] == 'addComment') && ($_GET['id'] > '0')) {//permet d'envoyer un commentaire
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $author =  htmlspecialchars($_POST['author']);//permet de convertir les balises en caractères
                    $comment = htmlspecialchars($_POST['comment']);//permet de convertir les balises en caractères
                    addComment($_GET['id'], $author, $comment);//appel au bon controller
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }


        else if($_GET['action'] == 'moderateCommentView'){//accède à la vue des commentaires signalés
            if( $_GET['id'] == null){//si un id n'est pas présent
                accessModerateCommentView();       
            }else {
                // Autre exception
                throw new Exception('C\'est vraiment pas gentil bien de toucher aux paramètres de l\'URL !'); 
            }
        }


        else if(($_GET['action'] == 'moderateComment') && ($_GET['id'] > '0')){//permet de remplacer "signalé" par "modéré" ds le champ moderate
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                pushModerateComment($_GET['id']);
            }else {
            // Autre exception
            throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        else if($_GET['action'] == 'moderated'){//permet de signaler un commentaire en entrant "signalé" ds la champ moderate de la bdd
            if(isset($_GET['id']) && $_GET['id'] > '0' && (isset($_GET['postId']) && $_GET['postId'] > '0')){
                moderatedComment($_GET['id'], $_GET['postId']);
                post($_GET['postId']);
            }else{
                // Autre exception
                throw new Exception('Toucher aux paramètres de l\'URL c\'est pas gentil ! :-)');
            }
        }

        else if($_GET['action'] == 'updateText'){//permet d'accéder à l'interface de modification de texte
            if(isset($_GET['id']) && $_GET['id'] > '0'){
                accessWysiwyg($_GET['id']);
            }else{
                // Autre exception
                throw new Exception('Toucher aux paramètres de l\'URL c\'est mal !');
            }
        }


        else if($_GET['action'] == 'updatePost'){//permet de modifier le titre et le texte d'un post
            if(isset($_GET['id']) && $_GET['id'] > '0'){
                if(!empty($_POST['updateResultat']) && !empty($_POST['updateTitle'])){//permet de remplacer un épisode
                    if($_GET['id'] > '0'){
                        updatepost($_GET['id'], $_POST['updateResultat'], $_POST['updateTitle']);
                    }else {
                        throw new Exception('Le numéro de l\'épisode n\'est pas supérieur à 0 !');
                    }
                }else {
                    throw new Exception('Vous n\'avez pas mis de texte de remplacement !');
                }  
            }else {
                throw new Exception('Toucher aux paramètres de l\'URL c\'est vraiment mal !');
            }            
        }


        else if($_GET['action'] == 'deletePost'){//permet la suppression d'un épisode
            if(isset($_GET['id']) && $_GET['id'] > '0'){
                    deletePost($_GET['id']);
            }else {
                throw new Exception('Toucher aux paramètres de l\'URL c\'est vraiment très mal !');
            }
        }

        
        else{
            throw new Exception('Le paramètre action ne correspond à aucun paramètre attendu !');
        }
    }
    else{
    showHomeView();//si pas de présence de paramètre action ds l'url, envoie à la vue de la page d'accueil
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
    require('view/frontend/errorView.php');
}