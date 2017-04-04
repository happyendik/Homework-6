<?php

class Controller
{

    public $model;
    public $view;
    public $actionVar;

    function __construct()
    {
        $this->view = new View();
    }

    function actionIndex()
    {
    }
}