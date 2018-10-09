<?php

namespace alban\projet_4\controller;

use \alban\projet_4\model\PostManager;//permet de ne pas spécifier à chaque le namespace lors de l'instanciation
use \alban\projet_4\model\CommentManager;
use \alban\projet_4\model\AccessManager;

class Backend
{
    const PREFIXE = "115599";
    const SUFFIXE = "D5ZC4Z";

    private $_postManager;
    private $_commentManager;
    private $_accessManager;

    public function __construct()
    {
        $this->_postManager = new PostManager();
        $this->_commentManager = new CommentManager();
        $this->_accessManager = new AccessManager();
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
    public function verifAccess($loginForm, $passwordForm)//fonction pour vérifier le logint et mot de passe
    {
        $login = $this->_accessManager->getLogin();
        $password = $this->_accessManager->getPassword();

        if(($login['loginAdministrator'] == $loginForm) && ($password['passwordAdministrator'] == (self::PREFIXE.hash("sha256",$passwordForm).self::SUFFIXE)))
        {
            $_SESSION['auth'] = true;
            $posts = $this->_postManager->getPosts();
            require('view/backend/administratorHomeView.php');
        }
        else{
            throw new RouteurException('Le login ou le mot de passe sont incorrect !');
        }
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

        $this->_commentManager->deleteComment($id);

        require('view/backend/administratorHomeView.php');
    }
    /***************************/
    public function deletePost(int $id)
    {
        $this->_postManager->deletePost($id);
        $posts = $this->_postManager->getPosts();

        $this->_commentManager->deleteComment($id);

        require('view/backend/administratorHomeView.php');
    }
}