<?php
class Autolader{
    static function register(){
        spl_autoload_register(array('__CLASS__', 'autoload'));
    }
    static function autoload($class_name){
        require 'controller' . $class_name . '.php';
        require 'model' . $class_name . '.php';
    }
}
?>
