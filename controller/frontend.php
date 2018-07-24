<?php

use \alban\project4\model\PostManager;

use \alban\project4\model\CommentManager;


// Chargement des classes
// require_once('../model/PostManager.php');
// require_once('../model/CommentManager.php');

function accessWysiwyg()
{
    require('../view/frontend/wysiwygInterface.php');
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

// function postA()//fonction pour afficher le billet selectionné et les commentaires associés
// {
//     $postManagerA = new PostManager();// Création d'un objet(instance)
//     $commentManagerA = new CommentManager();// Création d'un objet(instance)

//     $postA = $postManagerA->getPost($_GET['post_id']);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
//     // elle fait une requète préparé pour afficher le billet selectioné
//     $realyThisComment = $commentManagerA->getComment($_GET['id']);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
//     // elle fait une requète ds CommentManager.php pour afficher le commentaire associé au billet selectioné

//     require('../view/frontend/changePostView.php');
// }

// function addComment($postId, $author, $comment)//fonction qui permet d'envoyer un commentaire
// {
//     $commentManager = new CommentManager();// Création d'un objet(instance)

//     $affectedLines = $commentManager->postComment($postId, $author, $comment);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
//     //elle fait une requète ds CommentManager pour créer un commentaire

//     if ($affectedLines === false) {
//         throw new Exception('Impossible d\'ajouter le commentaire !');
//     }
//     else {
//         header('Location: index.php?action=post&id=' . $postId);
//     }

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
