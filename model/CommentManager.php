<?php

namespace alban\projet_4\model;

class CommentManager extends Manager
{
    /**
     * fonction pour insérer des commentaires en bdd
     * 
     * @param int $postId
     *  numéro correspondant à l'id du post
     * @param string $author
     *  nom de l'auteur qui envoit un commentaire
     * @param string $comment
     *  texte du commentaire
     */
    public function postComment($postId, $author, $comment)
    {
        $comments = self::$_db->prepare('INSERT INTO user (post_id, author, comment, creation_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    /**
     * fonction pour récupèrer les commentaires associés à l'épisode
     * 
     * @param int $postId
     *  numéro correspondant à l'id du post
     */
    public function getComments($postId)
    {
        // $db = $this->dbConnect();
        $comments = self::$_db->prepare('SELECT id, post_id, author, moderated, comment, creation_date, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM user WHERE post_id = ? ORDER BY creation_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    /**
     * fonction qui fait une requète avec jointure entre les 2 tables
     * 
     * sert à récupérer le titre de l'épisode sur la table "posts" et la date,
     * le nom de l'auteur et le texte de son commentaire sur la table "user"
     */
    public function accessModerateCommentView()
    {
        $commentsModerate = self::$_db->prepare('SELECT us.comment AS commentModerate, us.author
        AS authorComMod, us.id AS idComMod, us.moderated AS comMod, po.title AS titleComMod,
        DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr
        FROM user AS us
        INNER JOIN posts AS po
        ON us.post_id = po.id
        WHERE us.moderated = "signalé" || us.moderated = "modéré" ORDER BY creation_date DESC');
        $commentsModerate->execute(array());

        return $commentsModerate;
    }

    /**
     * fonction qui fait une requete pour modérer un commentaire
     * 
     * permet de remplacer "signalé" par "modéré" après q'un utilisateur ai signalé un commentaire
     * 
     * @param int $id
     *  numéro de l'épisode
     */
    public function pushModerated($id)
    {
        $moderate = self::$_db->prepare('UPDATE user SET moderated = "modéré" WHERE id = :newId');
        $moderate->execute(array(
            'newId' => $id
            ));
    }

    /**
     * fonction qui fait une requète pour signaler un commentaire
     * 
     * permet d'insérer "signalé" dans le champ moderated
     * 
     * @param int $id
     *  numéro de l'épisode
     */
    public function moderated($id)
    {
        $moderate = self::$_db->prepare('UPDATE user SET moderated = "signalé" WHERE id = :newId');
        $moderate->execute(array(
            'newId' => $id
            ));
    }

    /**
     * fonction qui efface les commentaires associés à un épisode
     * 
     * @param int $postId
     *  numéro correspondant à l'id du post
     */
    public function deleteComment($postId)
    {
        $delete = self::$_db->prepare('DELETE FROM user WHERE post_id = ?');
        $delete->execute(array($postId));
    }
}