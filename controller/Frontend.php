<?php

namespace alban\project_4\controller;

use \alban\project_4\model\PostManager;
use \alban\project_4\model\CommentManager;


// Chargement des classes
require_once('model/PostManager.php');//permet d'avoir accès aux méthodes du modèle
// require_once('model/CommentManager.php');//permet d'avoir accès aux méthodes du modèle

class Frontend
{
    private $_postManager;
    private $_commentManager;
    
    public function __construct()
    {
        $this->_postManager = new PostManager();
        $this->_commentManager = new CommentManager();
    }
    /************fonctions pour accéder aux vues*************/
    public function showHomeView()//appelé si aucun paramètre action n'est présent
    {
        require('view/frontend/homeView.php');
    }
    /***************************/
    public function posts()//fonction pour afficher tous les épisodes sur la page d'accueil de l'espace lecture
    {
        $posts = $this->_postManager->getPosts();

        require('view/frontend/readPostsHomeView.php');
    }
    /***************************/
    public function post(int $id)//fonction pour afficher l'épisode et ses commentaires
    {
        $post = $this->_postManager->getPost($id);
        
        $previousPostId = $this->_postManager->getPostInferior($id);
        $nextPostId = $this->_postManager->getPostSuperior($id);

        $comments = $this->_commentManager->getComments($id);

        require('view/frontend/readPostView.php');
    }
    /********************************/
    public function addComment(int $postId, string $author, string $comment)//fonction pour envoyer un commentaire
    {
        $post = $this->_postManager->getPost($postId);

        $affectedLines = $this->_commentManager->postComment($postId, $author, $comment);
        if($affectedLines === false){
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else{
            header('Location:index.php?action=accessPost&id=' . $postId);exit;
        }
    }
}