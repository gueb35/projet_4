<?php

namespace alban\projet_4\routeur;

use \alban\projet_4\controller\Frontend;
use \alban\projet_4\controller\Backend;

class Routeur{

    private $_frontend;
    private $_backend;

    public function __construct()
    {
        $this->_frontend = new Frontend();
        $this->_backend = new Backend();
    }

    /**
     * fonction contenant le bloc try/catch
     */
    public function routeur(){
        try{
            if(isset($_GET['action'])){//si le paramètre "action" est présent ds l'url
            $this->doAction();
            }
            else{
                $this->_frontend->showHomeView();
            }
        }
        catch(RouteurException $e) { // S'il y a eu une erreur, alors...
            require('view/frontend/errorView.php');
        }
    }

    /**
     * fonction contenant le bloc switch
     */
    private function doAction(){
        $action = $_GET['action'];
        switch($action)
        {
            case '':
                throw new RouteurException('C\'est pas bien de toucher aux paramètres de l\'URL !');
            break;

            case 'accessAdministrator':
                $this->_backend->accessAdministrator();//envoie à la vue de la page d'identification de l'administrateur
            break;

            case 'accessAdministratorHomeView':
                $this->_backend->postsAdministrator();
            break;

            case 'identification':
                $this->caseIdentification();//Appel à la fonction situé ds le bloc function
            break;

            case 'sendText':
                $this->caseSendText();//Appel à la fonction situé ds le bloc function
            break;

            case 'accessReadPosts':
                $this->_frontend->posts();
            break;

            case 'accessPost':
                $this->caseAccessPost();//Appel à la fonction situé ds le bloc function
            break;

            case 'addComment':
                $this->caseAddComment();//Appel à la fonction situé ds le bloc function
            break;

            case 'moderateCommentView':
                $this->_backend->accessModerateCommentView();
            break;

            case 'moderateComment'://modéré un commentaire
                $this->caseModerateComment();//Appel à la fonction situé ds le bloc function
            break;

            case 'moderated'://signalé un commentaire
                $this->caseModerated();//Appel à la fonction situé ds le bloc function
            break;

            case 'updateText':
                $this->caseUpdateText();//Appel à la fonction situé ds le bloc function
            break;

            case 'updatePost':
                $this->caseUpdatePost();//Appel à la fonction situé ds le bloc function
            break;

            case 'deletePost':
                $this->caseDeletePost();//Appel à la fonction situé ds le bloc function
            break;

            case 'stopSession':
                $this->_backend->stopSession();
            break;

            default : throw new RouteurException('Le paramètre ne correspond à aucun des paramètres attendues !');
        }
    }

    /**
     * bloc contenant les fonctions
     */
    private function caseIdentification(){
        if(!empty($_POST['login']) && !empty($_POST['password'])){//vérifie si les champs ont bien été remplis
            $this->_backend->verifAccess($_POST['login'], $_POST['password']);
        }else{
            throw new RouteurException('Vous n\'avez pas rempli tout les champs');
        }
    }
    private function caseSendText(){
        if(!empty($_POST['content_post']) && !empty($_POST['title']))
        {
            $_POST['content_post'] = (string) $_POST['content_post'];
            $_POST['title'] = (string) $_POST['title'];
            $this->_backend->sendText($_POST['content_post'], $_POST['title']);//envoie l'épisode en bdd
        }else{
            throw new RouteurException('Il n\'y a pas de texte dans la zone de rédaction des épisode !');
        }
    }
    private function caseAccessPost(){
        if(isset($_GET['id']))
        {
            $_GET['id'] = (int) $_GET['id'];
                if($_GET['id'] > '0')
                {
                    $this->_frontend->post($_GET['id']);
                }else if($_GET['id'] == '')
                {
                    // Autre exception
                    throw new RouteurException('Il n\'y a pas encore d\'épisode suivant.Patience, ça arrive !
                    Ou alors vous avez voulu entrer une chaîne de caractères (et ça c\'est pas bien !)');
                }else{
                    // Autre exception
                    throw new RouteurException('C\'est vraiment vraiment pas bien de toucher aux paramètres de l\'URL !');
                }
        }else{
            // Autre exception
            throw new RouteurException('Il n\'y a pas d\'identifiant dans l\'url !');
        }
    }
    private function caseAddComment(){
        if(isset($_GET['id']) && $_GET['id'] > 0)
        {
            $_GET['id'] = (int) $_GET['id'];
            if(!empty($_POST['author']) && !empty($_POST['comment']))
            {
                $this->_frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);//appel au bon controller
            }
            else{
                // Autre exception
                throw new RouteurException('Tous les champs ne sont pas remplis !');
            }
        }
        else{
            // Autre exception
            throw new RouteurException('Aucun identifiant de billet envoyé');
        }
    }
    private function caseModerateComment(){
        if(isset($_GET['id']) && $_GET['id'] > 0)
        {
            $_GET['id'] = (int) $_GET['id'];
            $this->_backend->pushModerateComment($_GET['id']);//modéré
        }else{
        // Autre exception
        throw new RouteurException('Aucun identifiant de billet envoyé');
        }
    }
    private function caseModerated(){
        if(isset($_GET['id']) && $_GET['id'] > '0' && (isset($_GET['postId']) && $_GET['postId'] > '0'))
        {
            $_GET['id'] = (int) $_GET['id'];
            $_GET['postId'] = (int) $_GET['postId'];
            $this->_backend->moderatedComment($_GET['id']);//signalé
            $this->_frontend->post($_GET['postId']);
        }else{
            // Autre exception
            throw new RouteurException('Toucher aux paramètres de l\'URL c\'est pas gentil ! :-(');
        }
    }
    private function caseUpdateText(){
        if(isset($_GET['id']) && $_GET['id'] > '0')
        {
            $_GET['id'] = (int) $_GET['id'];
            $this->_backend->accessWysiwyg($_GET['id']);
        }else{
            // Autre exception
            throw new RouteurException('Toucher aux paramètres de l\'URL c\'est mal !');
        }
    }
    private function caseUpdatePost(){
        if(isset($_GET['id']) && $_GET['id'] > '0')
        {
            $_GET['id'] = (int) $_GET['id'];
            if(!empty($_POST['updateContent_post']) && !empty($_POST['updateTitle']))//permet de remplacer un épisode
            {
                if($_GET['id'] > '0'){
                    $this->_backend->updatepost($_GET['id'], $_POST['updateContent_post'], $_POST['updateTitle']);
                }else{
                    throw new RouteurException('Le numéro de l\'épisode n\'est pas supérieur à 0 !');
                }
            }else{
                throw new RouteurException('Vous n\'avez pas mis de texte de remplacement !');
            }
        }else{
            throw new RouteurException('Toucher aux paramètres de l\'URL c\'est vraiment mal !');
        }
    }
    private function caseDeletePost(){
        if(isset($_GET['id']) && $_GET['id'] > '0')
        {
            $_GET['id'] = (int) $_GET['id'];
            $this->_backend->deletePost($_GET['id']);
        }else{
            throw new RouteurException('Toucher aux paramètres de l\'URL c\'est vraiment très mal !');
        }
    }
}
?>