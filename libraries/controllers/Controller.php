<?php

namespace Controllers;

abstract class Controller
{
    protected $model;
    protected $className;
    
    public function __construct()
    {
        $this->model = new $this->className();
    }
}
