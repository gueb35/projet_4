<?php

namespace alban\project_4\model;

require_once('model/Manager.php');//fait appel au fichier "Manager" pour la connexion à la bdd

class PostManager extends Manager
{
    public function postText($content_post, $title)//fonction qui fait une requète pour insérer des épisodes en bdd
    {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO posts(content_post, title) VALUES(?, ?)');
        $affectedLines = $post->execute(array($content_post, $title));

        return $affectedLines;
    }
    public function getPosts()//récupère tous les épidodes
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('SELECT id, title, content_post, SUBSTRING(content_post, 1, 500) AS short_post FROM posts');
        $posts->execute(array());
    
        return $posts;    
    }
    public function getPost($id)//récupère un épisode
    {
        $db = $this->dbConnect($id);
        $req = $db->prepare('SELECT id, title, content_post FROM posts WHERE id = ?');
        $req->execute(array($id));
        $post = $req->fetch();
    
        return $post;
    }
    public function getPostInferior($id)//récupère l'épisode précédent
    {
        $db = $this->dbConnect($id);
        $req = $db->prepare('SELECT id FROM posts WHERE id < ? ORDER BY id DESC LIMIT 1');
        $req->execute(array($id));
        $postId = $req->fetch();
    
        return $postId['id'];
    }  
    public function getPostSuperior($id)//récupère l'épisode suivant
    {
        $db = $this->dbConnect($id);
        $req = $db->prepare('SELECT id FROM posts WHERE id > ? LIMIT 1');
        $req->execute(array($id));
        $postId = $req->fetch();
        
        return $postId['id'];
    }  
    public function updatePost ($id, $content_post, $updateTitle)
    {
        $db = $this->dbConnect($id);
        $update = $db->prepare('UPDATE posts SET content_post = :newcontent_post, title = :newTitle WHERE id = :newId');
        $update->execute(array(
            'newcontent_post' => $content_post,
            'newTitle' => $updateTitle,
            'newId' => $id
        ));
    }     
    public function deletePost($id){
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM posts WHERE id = ? LIMIT 1');
        $delete->execute(array($id));
    }
    
}