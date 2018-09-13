<!--création du routeur
l'ensemble de ces conditions permet d'appeler le bon controleur-->
<?php define("PREFIXE", "115599"); ?>
<?php define("SUFFIXE", "D5ZC4Z"); ?>
<?php

require('../controller/frontend.php');

try{//on essaie de faire des choses
    if(isset($_GET['action'])){//si le paramètre "action" est présent ds l'url
        if($_GET['action'] == 'accessAdministrator'){
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


        else if($_GET['action'] == 'sendText'){
            if(!empty($_POST['resultat'])){
                sendText($_POST['resultat']);//envoie l'épisode en bdd
            }else{
                throw new Exception('Il n\'y a pas de texte dans la zone de rédaction des épisode !');
            }
            
        }


        //accède aux épisodes depuis le lien du menu de navigation(accès de base)
        else if($_GET['action'] == 'accessEpisodes'){
            posts();
        }
        else if(($_GET['action'] == 'accessEpisode') && ($_GET['id'] > '0')){//récupère un épisode et envoie à la vue ou on peut lire les épisodes
            post($_GET['id']);//permet d'afficher le premier épisode (id=1) ds la zone de lecture
        }


        else if (($_GET['action'] == 'addComment') && ($_GET['id'] > '0')) {//permet d'envoyer un commentaire
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);//appel au bon controller
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


        else if(($_GET['action'] == 'updateText') && ($_GET['id'] > '0')){
            accessWysiwyg($_GET['id']);
        }

        else if(($_GET['action'] == 'updatePost') && ($_GET['id'] > '0')){
            if(!empty($_POST['updateResultat'])){//permet de remplacer un épisode
                if($_GET['id'] > '0'){
                    updatepost($_GET['id'], $_POST['updateResultat']);
                }else {
                    throw new Exception('Le numéro de l\'épisode n\'est pas supérieur à 0 !');
                }
            }else {
                throw new Exception('Vous n\'avez pas mis de texte de remplacement !');
            }            
        }


        else if(($_GET['action'] == 'deletePost') && ($_GET['id'] > '0')){//permet la suppression d'un épisode
                    deletePost($_GET['id']);
        }else {
            throw new Exception('Le numéro de l\'épisode n\'est pas supérieur à 0 !');
        }
    }
    else{
    showHomeView();//si pas de présence de paramètre action ds l'url, envoie à la vue de la page d'accueil
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
    require('../view/frontend/errorView.php');
}