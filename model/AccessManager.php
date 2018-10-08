<?php

namespace alban\project_4\model;

class AccessManager extends Manager
{
    public function getLogin()//récupère le login
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT loginAdministrator FROM administrator');
        $req->execute(array());
        $login = $req->fetch();

        return $login;
    }
    public function getPassword()//récupère le mot de passe
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT passwordAdministrator FROM administrator');
        $req->execute(array());
        $password = $req->fetch();

        return $password;
    }
}