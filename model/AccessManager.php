<?php

namespace alban\projet_4\model;

class AccessManager extends Manager
{
    /**
     * fonction qui récupère le login
     */
    public function getLogin()
    {
        $req = self::$_db->prepare('SELECT loginAdministrator FROM administrator');
        $req->execute(array());
        $login = $req->fetch();

        return $login;
    }

    /**
     * fonction qui récupère le mot de passe
     */
    public function getPassword()//récupère le mot de passe
    {
        $req = self::$_db->prepare('SELECT passwordAdministrator FROM administrator');
        $req->execute(array());
        $password = $req->fetch();

        return $password;
    }
}