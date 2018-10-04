<?php

namespace alban\project_4\controller;

use \alban\project_4\model\PostManager;//permet de ne pas spécifier à chaque le namespace lors de l'instanciation
use \alban\project_4\model\CommentManager;


// Chargement des classes
// require_once('model/PostManager.php');//permet d'avoir accès aux méthodes du modèle
require_once('model/CommentManager.php');//permet d'avoir accès aux méthodes du modèle

class Backend//permet d'hériter des méthodes de la class CommentManager donc d'utiliser $this
{
    private $_postManager;
    private $_commentManager;
    
    public function __construct()
    {
        $this->_postManager = new PostManager();
        $this->_commentManager = new CommentManager();
    }
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
        $this->_postManager->postText($content_post, $title);
        $posts = $this->_postManager->getPosts();

        require('view/backend/administratorHomeView.php');
    }
    /***************************/
    public function postsAdministrator()//fonction pour afficher tous les épisodes sur la page d'accueil de l'espace administrateur
    {
        $posts = $this->_postManager->getPosts();

        require('view/backend/administratorHomeView.php');
    }
    /***************************/
    public function moderatedComment(string $commentId, int $id)//fonction pour signaler un commentaire
    {
        $this->_commentManager->moderated($commentId);
    }
    /***************************/
    public function pushModerateComment(int $id)//permet la modération d'un commentaire
    {
        $this->_commentManager->pushModerated($id);
        $commentsModerate = $this->_commentManager->accessModerateCommentView();
        
        require('view/backend/administratorModerateComment.php');
    }
    /***************************/
    public function accessModerateCommentView()//récupère des données ds 2 tables différentes
    {
        // $commentManager = new CommentManager();
        $commentsModerate = $this->_commentManager->accessModerateCommentView();

        require('view/backend/administratorModerateComment.php');
    }
    /***************************/
    public function accessWysiwyg(int $id)
    {
        $post = $this->_postManager->getPost($id);

        require('view/backend/administratorUpdateView.php');
    }
    /***************************/
    public function updatePost (int $id, string $content_post, string $updateTitle)
    {
        $this->_postManager->updatePost($id, $content_post, $updateTitle);
        $posts = $this->_postManager->getPosts();

        $this->deleteComment($id);
        
        require('view/backend/administratorHomeView.php');
    }
    /***************************/
    public function deletePost(int $id)
    {
        $this->_postManager->deletePost($id);
        $posts = $this->_postManager->getPosts();

        $this->deleteComment($id);

        require('view/backend/administratorHomeView.php');
    }
}