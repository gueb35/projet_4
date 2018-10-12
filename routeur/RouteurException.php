<?php

namespace alban\projet_4\routeur;

class RouteurException extends \Exception
{
    /**
     * constructeur permettant de faire appel au constructeur de la class mère Exception
     * 
     * @param string $message
     *  texte d'erreur adapté selon la situation rencontrée
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
    public function __toString()
    {
        return $this->message;
    }
}