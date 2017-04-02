<?php

class Controller {

    public $model;
    public $view;
    public $action_var;

    function __construct()
    {
        $this->view = new View();
    }

    function action_index()
    {
    }
}