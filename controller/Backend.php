<?php

namespace alban\project_4\controller;

use \alban\project_4\model\PostManager;//permet de ne pas spécifier à chaque le namespace lors de l'instanciation
use \alban\project_4\model\CommentManager;


// Chargement des classes
// require_once('model/PostManager.php');//permet d'avoir accès aux méthodes du modèle
require_once('model/CommentManager.php');//permet d'avoir accès aux méthodes du modèle

class Backend extends CommentManager//permet d'hériter des méthodes de la class CommentManager donc d'utiliser $this
{
    /************fonctions pour accéder aux vues directement*************/
    public function accessAdministrator()
    {
        require('view/backend/administratorAccessView.php');
    }
    public function stopSession()
    {
        require('view/backend/session.php');
    }
    /*************************/
    public function sendText(string $content_post, string $title){//permet d'envoyer un épisode en bdd
        $postManager = new PostManager();
        $postManager->postText($content_post, $title);
        $posts = $postManager->getPosts();

        require('view/backend/administratorHomeView.php');
    }
    /***************************/
    public function postsAdministrator()//fonction pour afficher tous les épisodes sur la page d'accueil de l'espace administrateur
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();

        require('view/backend/administratorHomeView.php');
    }
    /***************************/
    public function moderatedComment(string $commentId, int $id)//fonction pour signaler un commentaire
    {
        $this->moderated($commentId);
    }
    /***************************/
    public function pushModerateComment(int $id)//permet la modération d'un commentaire
    {
        $this->pushModerated($id);
        $commentManager = new CommentManager();
        $commentsModerate = $commentManager->accessModerateCommentView();
        
        require('view/backend/administratorModerateComment.php');
    }
    /***************************/
    public function accessModerateCommentView()//récupère des données ds 2 tables différentes
    {
        $commentManager = new CommentManager();
        $commentsModerate = $commentManager->accessModerateCommentView();

        require('view/backend/administratorModerateComment.php');
    }
    /***************************/
    public function accessWysiwyg(int $id)
    {
        $postManager = new PostManager();
        $post = $postManager->getPost($id);

        require('view/backend/administratorUpdateView.php');
    }
    /***************************/
    public function updatePost (int $id, string $content_post, string $updateTitle)
    {
        $postManager = new PostManager();
        $postManager->updatePost($id, $content_post, $updateTitle);
        $posts = $postManager->getPosts();

        $this->deleteComment($id);
        
        require('view/backend/administratorHomeView.php');
    }
    /***************************/
    public function deletePost(int $id)
    {
        $postManager = new PostManager();
        $postManager->deletePost($id);
        $posts = $postManager->getPosts();

        $this->deleteComment($id);

        require('view/backend/administratorHomeView.php');
    }
}