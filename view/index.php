<!--création du routeur
l'ensemble de ces conditions permet d'appeler le bon controleur-->
<?php

require('../controller/frontend.php');

try{//on essaie de faire des choses
    if(isset($_GET['action'])){//si le paramètre "action" est présent ds l'url
        if($_GET['action'] == 'accessAdministrator'){
            accessAdministrator();//envoie à la vue de la page d'identification de l'administrateur
        }
        else if($_GET['action'] == 'identification'){//si le paramètre "action" présent ds l'url est identification
            if(!empty($_POST['login']) && !empty($_POST['password'])){//vérifie si les champs ont bien été remplis
                if(($_POST['login'] == 'Jean_Forteroche') && ($_POST['password'] == 'Alaska')){//vérifie si le login et le password sont correct
                    accessWysiwyg();//envoie à l'interface d'écriture
                }else{
                    throw new Exception('Le login ou le mot de passe sont incorrect !');
                }
            }else{
                throw new Exception('Vous n\'avez pas rempli tout les champs');
            }
        } 
        else if($_GET['action'] == 'sendText'){
            if(!empty($_POST['resultat'])){
                // sendText();//envoie l'épisode en bdd
                showHomeView();//renvoie à la page d'accueil
            }else{
                throw new Exception('Il n\'y a pas de texte formater en html dans la zone prévue à cet effet !');
            }
            
        }
    }else{
    showHomeView();//si pas de présence de paramètre action ds l'url, envoie à la vue de la page d'accueil
    }
    //     elseif($_GET['action'] == 'post'){//sinon si le paramètre 'action' ds l'url est 'post'
    //         if(isset($_GET['id']) && $_GET['id'] > 0){
    //             post();//alors appelle la fonction post ds controller.php (appel au bon controller)
    //         }
    //         else{
    //             // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
    //             throw new Exception('Aucun identifiant de billet envoyé');
    //         }
    //     }
    //     elseif ($_GET['action'] == 'addComment') {
    //         if (isset($_GET['id']) && $_GET['id'] > 0) {
    //             if (!empty($_POST['author']) && !empty($_POST['comment'])) {
    //                 addComment($_GET['id'], $_POST['author'], $_POST['comment']);//appel au bon controller
    //             }
    //             else {
    //                 // Autre exception
    //                 throw new Exception('Tous les champs ne sont pas remplis !');
    //             }
    //         }
    //         else {
    //             // Autre exception
    //             throw new Exception('Aucun identifiant de billet envoyé');
    //         }
    //     }
    //     elseif ($_GET['action'] == 'postBis') {
    //         if ((isset($_GET['id']) && $_GET['id'] > 0) && ((isset($_GET['post_id'])) && ($_GET['post_id'] > 0))) {
    //                 postA();//appel au bon controller
    //         }
    //         else {
    //             // Autre exception
    //             throw new Exception('Aucun identifiant de billet envoyé');
    //         }
    //     }
    //     elseif ($_GET['action'] == 'changeComment') {//n'appelle qu'une action!!
    //         if (isset($_GET['id']) && $_GET['id'] > 0){
    //             if (!empty($_POST['comment'])) {
    //                 modifyComment($_GET['id'], $_POST('comment'));//permet de modifier le commentaire
    //             }
    //             else {
    //                 // Autre exception
    //                 throw new Exception('Tous les champs ne sont pas remplis !');
    //             }
    //         }
    //         else {
    //             // Autre exception
    //             throw new Exception('Aucun identifiant de billet envoyé');
    //         }
    //     }
    // }
    // else {
    //     listposts();//si il n'y a pas de paramètre acion ds l'url,
    //     // appelle la fonction listPosts pour afficher la liste des billets
    // }

}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
    require('../view/frontend/errorView.php');
}