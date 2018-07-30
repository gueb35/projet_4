<?php

namespace alban\project_4\model;

require_once('../model/Manager.php');//fait appel au fichier "Manager" pour la connexion à la bdd
//cela évite de dupliquer le code de connexion à la bdd

class CommentManager extends Manager
{
    public function postComment($postId, $author, $comment)//fonction qui fait une requète pour créer des commentaires
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comment_space (post_id, author, comment, creation_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }
    public function getComments($postId)//fonction qui fait une requète pour récupèrer les commentaires
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, post_id, author, comment, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comment_space WHERE post_id = ? ORDER BY creation_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }
    // public function getComments($postId)//fonction qui fait une requète pour récupèrer les commentaires
    // {
    //     $db = $this->dbConnect();
    //     $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
    //     $comments->execute(array($postId));

    //     return $comments;
    // }
    // public function getComment($id)//fonction qui fait une requète pour récupèrer un commentaire a besoin de l'id du commentaire
    // {
    //     $db = $this->dbConnect();//stocke la connexion
    //     $query = $db->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id=?');
    //     $query->execute(array($id));//execute la requete
    //     $comment = $query->fetch();//récupère le premier resultat
    //     return $comment;
    // }//ce qui est placé après SELECT permet d'y avoir accès

    // public function changeComment($id, $comment)//fonction qui fait une requète pour modifier un commentaire
    // {
    //     $db = $this->dbConnect();
    //     $query = $db->prepare('UPDATE comments SET comment=? WHERE id=? LIMIT 1');
    //     $query->execute(array($id, $comment));
    //     $switchComment = $query->fetch();
    //     var_dump($switchComment);die;
    //     return $switchComment;
    // }
}