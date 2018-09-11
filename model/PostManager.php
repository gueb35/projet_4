<?php

namespace alban\project_4\model;

require_once('../model/Manager.php');//fait appel au fichier "Manager" pour la connexion à la bdd
//cela évite de dupliquer le code de connexion à la bdd

class PostManager extends Manager
{
    public function postText($resultat)//fonction qui fait une requète pour insérer des épisodes en bdd
    {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO author(resultat) VALUES(?)');
        $affectedLines = $post->execute(array($resultat));

        return $affectedLines;
    }
    public function getPosts()
    {
        $db = $this->dbConnect();
        $posts = $db->query('SELECT id,resultat, SUBSTRING(resultat, 1, 500) AS short_post FROM author');
    
        return $posts;    
    }
    public function getPost($id)//récupère un épisode
    {
        $db = $this->dbConnect($id);
        $req = $db->prepare('SELECT id, resultat FROM author WHERE id = ?');
        $req->execute(array($id));
        $post = $req->fetch();
    
        return $post;
    }
    public function getPostInferior($id)//récupère l'épisode précédent
    {
        $db = $this->dbConnect($id);
        $req = $db->prepare('SELECT id FROM author WHERE id < ? ORDER BY id DESC LIMIT 1');
        $req->execute(array($id));
        $postId = $req->fetch();
    
        return $postId['id'];
    }  
    public function getPostSuperior($id)//récupère l'épisode suivant
    {
        $db = $this->dbConnect($id);
        $req = $db->prepare('SELECT id FROM author WHERE id > ? LIMIT 1');
        $req->execute(array($id));
        $postId = $req->fetch();
        
        return $postId['id'];
    }  
    public function updatePost ($id, $resultat){
        $db = $this->dbConnect($id);
        $update = $db->prepare('UPDATE author SET resultat = :newResultat WHERE id = :newId');
        $update->execute(array(
            'newResultat' => $resultat,
            'newId' => $id
        ));
    }     
    public function deletePost($id){
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM author WHERE id = ? LIMIT 1');
        $delete->execute(array($id));
    }
    
}