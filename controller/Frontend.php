<?php

namespace alban\project_4\controller;

use \alban\project_4\model\PostManager;

use \alban\project_4\model\CommentManager;


// Chargement des classes
require_once('model/PostManager.php');//permet d'avoir accès aux méthodes du modèle
require_once('model/CommentManager.php');//permet d'avoir accès aux méthodes du modèle

class Frontend
{
    /************fonctions pour accéder aux vues*************/
    public function showHomeView()//appelé si aucun paramètre action n'est présent
    {
        require('view/frontend/homeView.php');
    }
    public function accessAdministrator()//appelé si le paramètre action est accessAdministrator et qu'il n'y a pas d'id
    {
        require('view/backend/administratorAccessView.php');
    }
    public function accessAdministratorModerateComment()//appelé si le paramètre action est accessAdministratorModerateComment et qu'il n'y a pas d'id
    {
        require('view/backend/administratorModerateComment.php');
    }
    /*************************/
    public function sendText($content_post, $title){//permet d'envoyer un épisode en bdd
        $postManager = new PostManager();
        $postManager->postText($content_post, $title);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
        $posts = $postManager->getPosts();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet)

        require('view/backend/administratorHomeView.php');
    }
    /***************************/
    public function postsAdministrator()//fonction pour afficher tous les épisodes sur la page d'accueil de l'espace administrateur
    {
        $postManager = new PostManager();// Création d'un objet(instance)
        $posts = $postManager->getPosts();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet)

        require('view/backend/administratorHomeView.php');
    }
    /***************************/
    public function posts()//fonction pour afficher tous les épisodes sur la page d'accueil de l'espace lecture
    {
        $postManager = new PostManager();// Création d'un objet(instance)
        // $postTitle = $postManager->postText($content_post, $title);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
        $posts = $postManager->getPosts();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

        require('view/frontend/readPostsHomeView.php');
    }
    /***************************/
    public function post($id)//fonction pour afficher l'épisode et ses commentaires
    {
        $postManager = new PostManager();// Création d'un objet(instance)
        $post = $postManager->getPost($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
        
        $previousPostId = $postManager->getPostInferior($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
        $nextPostId = $postManager->getPostSuperior($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

        $commentManager = new CommentManager();// Création d'un objet(instance)
        $comments = $commentManager->getComments($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
        // elle fait une requète ds CommentManager.php pour afficher les commentaires associés au billet selectionné

        require('view/frontend/readPostView.php');//transmet les données(requete stockées ds des variables) à l'affichage (vue)
    }
    /********************************/
    public function addComment($postId, $author, $comment)
    {
        $postManager = new PostManager();
        $post = $postManager->getPost($postId);

        $commentManager = new CommentManager();
        $affectedLines = $commentManager->postComment($postId, $author, $comment);
        if($affectedLines === false){
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else{
            header('Location:index.php?action=accessEpisode&id=' . $postId);exit;
        }
    }
    /***************************/
    public function moderatedComment($commentId,$id)
    {
        $commentManager = new CommentManager();// Création d'un objet(instance)
        $commentManager->moderated($commentId);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

    }
    /***************************/
    public function pushModerateComment($id){
        $commentManager = new CommentManager();// Création d'un objet(instance)
        $commentManager->pushModerated($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
        $commentsModerate = $commentManager->accessModerateCommentView();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),
        
        require('view/backend/administratorModerateComment.php');
    }
    /***************************/
    public function accessModerateCommentView()
    {
        $commentManager = new CommentManager();// Création d'un objet(instance)
        $commentsModerate = $commentManager->accessModerateCommentView();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

        require('view/backend/administratorModerateComment.php');
    }
    /***************************/
    public function accessWysiwyg($id)
    {
        $postManager = new PostManager();
        $post = $postManager->getPost($id);// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

        require('view/backend/administratorUpdateView.php');
    }
    /***************************/
    public function updatePost ($id, $content_post, $updateTitle)
    {
        $postManager = new PostManager();// Création d'un objet(instance)
        $postManager->updatePost($id, $content_post, $updateTitle);//invoquer la méthode pour modifier un épisode
        $posts = $postManager->getPosts();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),

        $commentManager = new CommentManager();
        $commentManager->deleteComment($id);
        
        require('view/backend/administratorHomeView.php');
    }
    /***************************/
    public function deletePost($id)
    {
        $postManager = new PostManager();
        $postManager->deletePost($id);//invoquer la méthode pour supprimer un épisode
        $posts = $postManager->getPosts();// Appel d'une fonction de cet objet(invoquer la méthode de cet objet),


        $commentManager = new CommentManager();
        $commentManager->deleteComment($id);

        require('view/backend/administratorHomeView.php');

    }
}