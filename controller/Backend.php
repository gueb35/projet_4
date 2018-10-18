<?php

namespace alban\projet_4\controller;

use \alban\projet_4\model\PostManager;
use \alban\projet_4\model\CommentManager;
use \alban\projet_4\model\AccessManager;
use \alban\projet_4\routeur\RouteurException;

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

    /**
     *fonction pour accéder directement à la vue pour identification de l'administrateur
     */
    public function accessAdministrator()
    {
        require('view/backend/administratorAccessView.php');
    }

    /**
     * fonction pour détruire la session accessible depuis le bouton déconnexion du menu du template Admin
     */
    public function stopSession()
    {
        //Détruit la session
        $_SESSION = array();
        session_destroy();
        header('location:index.php');
    }

    /**
     *fonction pour envoyer un épisode en bdd
     */
    public function sendText(string $content_post, string $title){
        $this->_postManager->postText($content_post, $title);
        $posts = $this->_postManager->getPosts();

        require('view/backend/administratorHomeView.php');
    }

    /**
     * fonction pour afficher tous les épisodes sur la page d'accueil de l'espace administrateur
     */
    public function postsAdministrator(){
        $posts = $this->_postManager->getPosts();

        require('view/backend/administratorHomeView.php');
    }

    /**
     * fonction pour vérifier le login et mot de passe
     */
    public function verifAccess(string $loginForm, string $passwordForm)
    {
        $loginAndPassword = $this->_accessManager->getLoginAndPassword();
        // var_dump($loginAndPassword);die;
        // $password = $this->_accessManager->getPassword();

        if(($loginAndPassword['loginAdministrator'] == $loginForm) && ($loginAndPassword['passwordAdministrator'] == (self::PREFIXE.hash("sha256",$passwordForm).self::SUFFIXE)))
        {
            $_SESSION['auth'] = true;
            $posts = $this->_postManager->getPosts();
            require('view/backend/administratorHomeView.php');
        }
        else{
            throw new RouteurException('Le login ou le mot de passe sont incorrect !');
        }
    }

    /**
     * fonction pour signaler un commentaire
     */
    public function moderatedComment(int $commentId)
    {
        $this->_commentManager->moderated($commentId);
    }

    /**
     * fonction pour modérer d'un commentaire
     */
    public function pushModerateComment(int $id)
    {
        $this->_commentManager->pushModerated($id);
        $commentsModerate = $this->_commentManager->accessModerateCommentView();

        require('view/backend/administratorModerateComment.php');
    }

    /**
     * fonction pour récupèrer des données ds 2 tables différentes
     */
    public function accessModerateCommentView()
    {
        $commentsModerate = $this->_commentManager->accessModerateCommentView();

        require('view/backend/administratorModerateComment.php');
    }

    /**
     * fonction pour accéder à la vue de modification d'un post
     */
    public function accessWysiwyg(int $id)
    {
        $post = $this->_postManager->getPost($id);

        require('view/backend/administratorUpdateView.php');
    }

    /**
     * fonction pour modifier un post
     */
    public function updatePost(int $id, string $content_post, string $updateTitle)
    {
        $this->_postManager->updatePost($id, $content_post, $updateTitle);
        $posts = $this->_postManager->getPosts();

        $this->_commentManager->deleteComment($id);

        require('view/backend/administratorHomeView.php');
    }

    /**
     * fonction pour effacer un post et les commentaires associés
     */
    public function deletePost(int $id)
    {
        $this->_postManager->deletePost($id);
        $posts = $this->_postManager->getPosts();

        $this->_commentManager->deleteComment($id);

        require('view/backend/administratorHomeView.php');
    }
}