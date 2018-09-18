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
    public function accessModerateCommentView()
    {
        $db = $this->dbConnect();
        $commentsModerate = $db->prepare('SELECT id, post_id, author, moderated, comment, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comment_space WHERE moderated = "ok" ORDER BY creation_date DESC');
        $commentsModerate->execute(array());

        return $commentsModerate;
    }
    public function moderated($id)//fonction qui fait une requète pour signaler un commentaire
    {
        $db = $this->dbConnect();
        $moderate = $db->prepare('UPDATE comment_space SET moderated = "ok" WHERE id = :newId');
        $moderate->execute(array(
            'newId' => $id
            ));
    }
    public function deleteComment($postId){//efface les commentaires associés à un épisode
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM comment_space WHERE post_id = ?');
        $delete->execute(array($postId));
    }
}