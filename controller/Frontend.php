<?php

namespace alban\projet_4\controller;

use \alban\projet_4\model\PostManager;
use \alban\projet_4\model\CommentManager;

class Frontend
{
    private $_postManager;
    private $_commentManager;

    public function __construct()
    {
        $this->_postManager = new PostManager();
        $this->_commentManager = new CommentManager();
    }

    /**
     * fonction pour accéder à la vue de la page d'accueil 
     */
    public function showHomeView()//appelé si aucun paramètre action n'est présent
    {
        require('view/frontend/homeView.php');
    }

    /**
     * fonction pour afficher tous les épisodes sur la page d'accueil de l'espace lecture
     */
    public function posts()
    {
        $posts = $this->_postManager->getPosts();

        require('view/frontend/readPostsHomeView.php');
    }

    /**
     * fonction pour afficher l'épisode et ses commentaires
     */
    public function post(int $id)
    {
        $post = $this->_postManager->getPost($id);

        $previousPostId = $this->_postManager->getPostInferior($id);
        $nextPostId = $this->_postManager->getPostSuperior($id);

        $comments = $this->_commentManager->getComments($id);

        require('view/frontend/readPostView.php');
    }

    /**
     * fonction pour envoyer un commentaire
     */
    public function addComment(int $postId, string $author, string $comment)
    {
        $post = $this->_postManager->getPost($postId);

        $author =  htmlspecialchars($_POST['author']);//permet de convertir les balises en caractères avant d'enregistrer en bdd
        $comment = htmlspecialchars($_POST['comment']);//donc de bloquer l'execution d'un script
        $affectedLines = $this->_commentManager->postComment($postId, $author, $comment);
        if($affectedLines === false){
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else{
            header('Location:index.php?action=accessPost&id=' . $postId);exit;
        }
    }
}