<?php

use \alban\project_4\model\PostManager;

use \alban\project_4\model\CommentManager;


// Chargement des classes
require_once('../model/PostManager.php');
require_once('../model/CommentManager.php');
/************fonctions pour accéder aux vues*************/
function showHomeView()
{
    require('../view/frontend/homeView.php');
}
function accessAdministrator()
{
    require('../view/frontend/administratorAccessView.php');
}
function accessWysiwyg()
{
    require('../view/frontend/wysiwygInterface.php');
}
function accessEpisode(){
    require('../view/frontend/readEpisodeView.php');
}
/*************************/
function sendText($resultat){//permet d'envoyer un épisode en bdd
    $postManager = new PostManager();
    $affectedLines = $postManager->postText($resultat);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

    // if ($affectedLines === false) {
    //     throw new Exception('Impossible d\'ajouter l'épisode !');
    // }
    // else {
    //     header('Location: index.php?action=post&id=' . $postId);
    // }
}
/***************************/
function post($id)//fonction pour afficher l'épisode
{
    $postManager = new PostManager();// Création d'un objet(instance)

    $post = $postManager->getPost($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
    // elle fait une requète préparé pour afficher le billet selectioné

    require('../view/frontend/readEpisodeView.php');//transmet les données(requete stockées ds des variables) à l'affichage (vue)
}
/********************************/
function addComment($postId, $author, $comment)//fonction qui permet d'envoyer un commentaire
{
    $postManager = new PostManager();// Création d'un objet(instance)
    $post = $postManager->getPost($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
    // elle fait une requète préparé pour afficher le billet selectionné

    $commentManager = new CommentManager();// Création d'un objet(instance)
    $affectedLines = $commentManager->postComment($postId, $author, $comment);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
    //elle fait une requète ds CommentManager pour créer un commentaire
    
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=accessEpisode&id=' . $postId);
    }

function showComments($id)//fonction pour afficher les commentaires
{
    $commentManager = new CommentManager();// Création d'un objet(instance)
    $comments = $commentManager->getComments($_GET['id']);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
    // elle fait une requète ds CommentManager.php pour afficher le commentaire associé au billet selectioné

    require('../view/frontend/readEpisodeView.php');//transmet les données(requete stockées ds des variables) à l'affichage (vue)
}


}
// function listPosts()//fonction utilisé pour lister tous les billets
// {
//     $postManager = new PostManager(); // Création d'un objet(instance)
//     $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
//     // elle fait une requete ds PostManager.php pour afficher tous les billets

//     require('../view/frontend/listPostsView.php');//transmet les données(requete stockées ds des variables) à l'affichage (vue)


// }

// function post()//fonction pour afficher le billet selectionné et les commentaires associés
// {
//     $postManager = new PostManager();// Création d'un objet(instance)
//     $commentManager = new CommentManager();// Création d'un objet(instance)

//     $post = $postManager->getPost($_GET['id']);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
//     // elle fait une requète préparé pour afficher le billet selectioné
//     $comments = $commentManager->getComments($_GET['id']);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
//     // elle fait une requète ds CommentManager.php pour afficher le commentaire associé au billet selectioné

//     require('../view/frontend/postView.php');//transmet les données(requete stockées ds des variables) à l'affichage (vue)
// }

// function modifyComment($id, $comment)//fonction qui permet de modifier un commentaire
// {
//     $postManager = new PostManager();// Création d'un objet(instance)
//     $post = $postManager->getPost($_GET['id']);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

//     $commentManager = new CommentManager();// Création d'un objet(instance)
//     $changeComment = $commentManager->changeComment($_GET['id'], $_POST('comment'));//invoquer la méthode de cet objet elle fait un requète préparé pour afficher le billet selectioné
//     $comments = $commentManager->getComments($_GET['id']);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
//     // elle fait un requète ds CommentManager.php pour afficher le commentaire associé au billet selectioné

//     require('../view/frontend/postView.php');//transmet les données(requete stockées ds des variables) à l'affichage (vue)
// }
