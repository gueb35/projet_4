<?php

namespace alban\project_4\model;

require_once('../model/Manager.php');//fait appel au fichier "Manager" pour la connexion à la bdd
//cela évite de dupliquer le code de connexion à la bdd

class PostManager extends Manager
{
    public function postText($resultat)//fonction qui fait une requète pour insérer des épisodes en bdd
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO author(resultat) VALUES(?, NOW())');
        $affectedLines = $comments->execute(array($resultat));

        return $affectedLines;
    }
    // public function getPosts()//récupère tous les épisodes
    // {
    //     $db = $this->dbConnect();
    //     $req = $db->query('SELECT id, author, title, content, FROM author ORDER BY id');

    //     return $req;
    // }
}