<?php

namespace alban\projet_4\model;

class AccessManager extends Manager
{
    /**
     * fonction qui récupère le login
     */
    public function getLoginAndPassword()
    {
        $req = self::$_db->prepare('SELECT loginAdministrator, passwordAdministrator FROM administrator');
        $req->execute();
        $loginAndPassword = $req->fetch();

        return $loginAndPassword;
    }
}