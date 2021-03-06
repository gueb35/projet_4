<?php

namespace alban\projet_4\model;

abstract class Manager
{
    static protected $_db;

    public function __construct()
    {
        if(self::$_db == null)
        {
            self::$_db = new \PDO('mysql:host=localhost;dbname=projet4;charset=utf8', 'root', '');
        }
    }
}