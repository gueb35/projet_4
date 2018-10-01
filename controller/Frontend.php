<?php

namespace alban\project_4\controller;

use \alban\project_4\model\PostManager;
use \alban\project_4\model\CommentManager;


// Chargement des classes
require_once('model/PostManager.php');//permet d'avoir accès aux méthodes du modèle
// require_once('model/CommentManager.php');//permet d'avoir accès aux méthodes du modèle

class Frontend extends PostManager
{
    /************fonctions pour accéder aux vues*************/
    public function showHomeView()//appelé si aucun paramètre action n'est présent
    {
        require('view/frontend/homeView.php');
    }
    /***************************/
    public function posts()//fonction pour afficher tous les épisodes sur la page d'accueil de l'espace lecture
    {
        $posts = $this->getPosts();

        require('view/frontend/readPostsHomeView.php');
    }
    /***************************/
    public function post($id)//fonction pour afficher l'épisode et ses commentaires
    {
        $post = $this->getPost($id);
        
        $previousPostId = $this->getPostInferior($id);
        $nextPostId = $this->getPostSuperior($id);

        $commentManager = new CommentManager();
        $comments = $commentManager->getComments($id);

        require('view/frontend/readPostView.php');
    }
    /********************************/
    public function addComment($postId, $author, $comment)//fonction pour envoyer un commentaire
    {
        $post = $this->getPost($postId);

        $commentManager = new CommentManager();
        $affectedLines = $commentManager->postComment($postId, $author, $comment);
        if($affectedLines === false){
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else{
            header('Location:index.php?action=accessPost&id=' . $postId);exit;
        }
    }
}