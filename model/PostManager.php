<?php

namespace alban\project4\model;

require_once('../model/Manager.php');//fait appel au fichier "Manager" pour la connexion à la bdd
//cela évite de dupliquer le code de connexion à la bdd

class PostManager extends Manager
{
    public function getPosts()//récupère tous les épisodes
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, author, title, content, FROM author ORDER BY id');

        return $req;
    }
}