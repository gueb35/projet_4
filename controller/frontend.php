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
    require('../view/backend/administratorAccessView.php');
}
function accessAdministratorModerateComment()
{
    require('../view/backend/administratorModerateComment.php');
}
function accessEpisode(){
    require('../view/frontend/readEpisodeView.php');
}
/*************************/
function sendText($resultat, $title){//permet d'envoyer un épisode en bdd
    $postManager = new PostManager();
    $postManager->postText($resultat, $title);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
    $posts = $postManager->getPosts();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet)

    require('../view/backend/administratorHomeView.php');
}
/***************************/
function postsAdministrator()//fonction pour afficher tous les épisodes sur la page d'accueil de l'espace administrateur
{
    $postManager = new PostManager();// Création d'un objet(instance)
    $posts = $postManager->getPosts();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet)

    // $commentManager = new CommentManager();// Création d'un objet(instance)
    // $commentModerate = $commentManager->getCommentModerate($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

    require('../view/backend/administratorHomeView.php');
}
/***************************/
function posts()//fonction pour afficher tous les épisodes sur la page d'accueil de l'espace lecture
{
    $postManager = new PostManager();// Création d'un objet(instance)
    // $postTitle = $postManager->postText($resultat, $title);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
    $posts = $postManager->getPosts();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

    require('../view/frontend/readEpisodesHomeView.php');
}
/***************************/
function post($id)//fonction pour afficher l'épisode et ses commentaires
{
    $postManager = new PostManager();// Création d'un objet(instance)
    $post = $postManager->getPost($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
    
    $previousPostId = $postManager->getPostInferior($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
    $nextPostId = $postManager->getPostSuperior($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

    $commentManager = new CommentManager();// Création d'un objet(instance)
    $comments = $commentManager->getComments($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
    // elle fait une requète ds CommentManager.php pour afficher les commentaires associés au billet selectionné

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
}
/***************************/
function moderatedComment($commentId,$id)
{
    $commentManager = new CommentManager();// Création d'un objet(instance)
    $commentManager->moderated($commentId);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

}
/***************************/
function pushModerateComment($id){
    $commentManager = new CommentManager();// Création d'un objet(instance)
    $commentManager->pushModerated($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
    $commentsModerate = $commentManager->accessModerateCommentView();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
    
    require('../view/backend/administratorModerateComment.php');
}
/***************************/
function accessModerateCommentView()
{
    $commentManager = new CommentManager();// Création d'un objet(instance)
    $commentsModerate = $commentManager->accessModerateCommentView();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

    require('../view/backend/administratorModerateComment.php');
}
/***************************/
function accessWysiwyg($id)
{
    $postManager = new PostManager();
    $post = $postManager->getPost($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

    require('../view/backend/administratorUpdateView.php');
}
/***************************/
function updatePost ($id, $resultat, $updateTitle)
{
    $postManager = new PostManager();// Création d'un objet(instance)
    $postManager->updatePost($id, $resultat, $updateTitle);//invoquer la méthode pour modifier un épisode
    $posts = $postManager->getPosts();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

    $commentManager = new CommentManager();
    $commentManager->deleteComment($id);
    
    require('../view/backend/administratorHomeView.php');
}
/***************************/
function deletePost($id)
{
    $postManager = new PostManager();
    $postManager->deletePost($id);//invoquer la méthode pour supprimer un épisode
    $posts = $postManager->getPosts();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),


    $commentManager = new CommentManager();
    $commentManager->deleteComment($id);

    require('../view/backend/administratorHomeView.php');

}