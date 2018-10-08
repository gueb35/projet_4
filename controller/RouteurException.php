<?php

namespace alban\project_4\controller; 

class RouteurException extends \Exception
{
    public function __construct ($message)
    {
        parent::__construct($message);
    }
    public function __toString()
    {
        return $this->message;
    }
}