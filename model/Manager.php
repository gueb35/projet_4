<?php

namespace alban\projet_4\model;

abstract class Manager
{
    /**
     * fonction pour la connexion à la bdd
     * 
     * @param host
     *  nom d'hôte
     * @param dbname
     *  nom de la bdd
     * @param charset
     *  encodage
     * @param string
     *  nom d'utilisateur
     * @param string
     *  mdp bdd
     */
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        return $db;
    }
}