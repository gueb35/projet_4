<?php

namespace alban\project_4\model;

require_once('model/Manager.php');//fait appel au fichier "Manager" pour la connexion à la bdd
//cela évite de dupliquer le code de connexion à la bdd

class CommentManager extends Manager
{
    public function postComment($postId, $author, $comment)//fonction qui fait une requète pour créer des commentaires
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO user (post_id, author, comment, creation_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }
    public function getComments($postId)//fonction qui fait une requète pour récupèrer les commentaires
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, post_id, author, moderated, comment, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM user WHERE post_id = ? ORDER BY creation_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }
    public function accessModerateCommentView()//requète avec jointure entre les 2 tables
    {
        $db = $this->dbConnect();
        $commentsModerate = $db->prepare('SELECT us.comment AS commentModerate, us.author 
        AS authorComMod, us.id AS idComMod, us.moderated AS comMod, po.title AS titleComMod,
        DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr 
        FROM user AS us
        INNER JOIN posts AS po
        ON us.post_id = po.id 
        WHERE us.moderated = "signalé" || us.moderated = "modéré" ORDER BY creation_date DESC');
        $commentsModerate->execute(array());

        return $commentsModerate;
    }
    public function pushModerated($id)//fonction qui fait une requete pour modérer un commentaire
    {
        $db = $this->dbConnect();
        $moderate = $db->prepare('UPDATE user SET moderated = "modéré" WHERE id = :newId');
        $moderate->execute(array(
            'newId' => $id
            ));
    }
    public function moderated($id)//fonction qui fait une requète pour signaler un commentaire
    {
        $db = $this->dbConnect();
        $moderate = $db->prepare('UPDATE user SET moderated = "signalé" WHERE id = :newId');
        $moderate->execute(array(
            'newId' => $id
            ));
    }
    public function deleteComment($postId){//efface les commentaires associés à un épisode
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM user WHERE post_id = ?');
        $delete->execute(array($postId));
    }
}