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
        var_dump($id, $resultat);die;
        $db = $this->dbConnect();
        $update = $db->prepare('UPDATE author SET resultat = $resultat WHERE id = $id');
        $update->execute(array($id));
    }     
    public function deletePost($id){
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM author WHERE id = ? LIMIT 1');
        $delete->execute(array($id));
    }
}
// public function getPosts()//récupère tous les épisodes
// {
//     $db = $this->dbConnect();
//     $req = $db->query('SELECT id, author, title, content, FROM author ORDER BY id');

//     return $req;
// }

// public function getPost($postId)//récupère le billet selectionné
// {
//     $db = $this->dbConnect();
//     $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
//     $req->execute(array($postId));
//     $post = $req->fetch();

//     return $post;
// }