<?php

namespace alban\project_4\controller;

use \alban\project_4\model\PostManager;

use \alban\project_4\model\CommentManager;


// Chargement des classes
require_once('model/PostManager.php');//permet d'avoir accès aux méthodes du modèle
require_once('model/CommentManager.php');//permet d'avoir accès aux méthodes du modèle

class Backend
{
    /************fonctions pour accéder aux vues*************/
    public function accessAdministrator()
    {
        require('view/backend/administratorAccessView.php');
    }
    public function accessAdministratorModerateComment()
    {
        require('view/backend/administratorModerateComment.php');
    }
    /*************************/
    public function sendText($content_post, $title){//permet d'envoyer un épisode en bdd
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
    public function pushModerateComment($id){
        $commentManager = new CommentManager();
        $commentManager->pushModerated($id);
        $commentsModerate = $commentManager->accessModerateCommentView();
        
        require('view/backend/administratorModerateComment.php');
    }
    /***************************/
    public function accessModerateCommentView()
    {
        $commentManager = new CommentManager();
        $commentsModerate = $commentManager->accessModerateCommentView();

        require('view/backend/administratorModerateComment.php');
    }
    /***************************/
    public function accessWysiwyg($id)
    {
        $postManager = new PostManager();
        $post = $postManager->getPost($id);

        require('view/backend/administratorUpdateView.php');
    }
    /***************************/
    public function updatePost ($id, $content_post, $updateTitle)
    {
        $postManager = new PostManager();
        $postManager->updatePost($id, $content_post, $updateTitle);
        $posts = $postManager->getPosts();

        $commentManager = new CommentManager();
        $commentManager->deleteComment($id);
        
        require('view/backend/administratorHomeView.php');
    }
    /***************************/
    public function deletePost($id)
    {
        $postManager = new PostManager();
        $postManager->deletePost($id);
        $posts = $postManager->getPosts();

        $commentManager = new CommentManager();
        $commentManager->deleteComment($id);

        require('view/backend/administratorHomeView.php');
    }
}