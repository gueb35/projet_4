<?php

namespace alban\projet_4\model;

class PostManager extends Manager
{
    /**
     * fonction pour insérer des épisodes en bdd
     * 
     * @param string $content_post
     *  texte de l'épisode
     * @param string $title
     *  titre de l'épisode
     */
    public function postText($content_post, $title)
    {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO posts(content_post, title) VALUES(?, ?)');
        $affectedLines = $post->execute(array($content_post, $title));

        return $affectedLines;
    }

    /**
     * récupère tous les épidodes
     */
    public function getPosts()
    {
        $db = $this->dbConnect();
        $posts = $db->prepare('SELECT id, title, content_post, SUBSTRING(content_post, 1, 500) AS short_post FROM posts');
        $posts->execute(array());

        return $posts;
    }

    /**
     * récupère un épisode
     * 
     * @param int $id
     *  numéro de l'épisode
     */
    public function getPost($id)
    {
        $db = $this->dbConnect($id);
        $req = $db->prepare('SELECT id, title, content_post FROM posts WHERE id = ?');
        $req->execute(array($id));
        $post = $req->fetch();

        return $post;
    }

    /**
     * récupère l'épisode précédent
     * 
     * @param int $id
     *  numéro de l'épisode
     */
    public function getPostInferior($id)
    {
        $db = $this->dbConnect($id);
        $req = $db->prepare('SELECT id FROM posts WHERE id < ? ORDER BY id DESC LIMIT 1');
        $req->execute(array($id));
        $postId = $req->fetch();

        return $postId['id'];
    }

    /**
     * récupère l'épisode suivant
     * 
     * @param int $id
     *  numéro de l'épisode
     */
    public function getPostSuperior($id)
    {
        $db = $this->dbConnect($id);
        $req = $db->prepare('SELECT id FROM posts WHERE id > ? LIMIT 1');
        $req->execute(array($id));
        $postId = $req->fetch();

        return $postId['id'];
    }

    /**
     * fonction pour modifier un épisode et son titre
     * 
     * @param int $id
     *  numéro de l'épisode
     * @param string $content_post
     *  texte de l'épisode
     * @param string $updateTitle
     *  titre de l'épisode
     */
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

    /**
     * fonction qui efface un épisode
     * 
     * @param int $id
     *  numéro de l'épisode
     */
    public function deletePost($id){
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM posts WHERE id = ? LIMIT 1');
        $delete->execute(array($id));
    }
}