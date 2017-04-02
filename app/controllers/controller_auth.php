<?php

class Controller_auth extends Controller
{

    function __construct()
    {
        $this->model = new Model_auth();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->statusModel; //вывод ошибок и замечаний
        $this->view->generate('auth_view.php', 'template_view.php', $data);
    }

    public function action_post()
    {
        $this->model->postHandler();
        $data = $this->model->statusModel; //вывод ошибок и замечаний
        $this->view->generate('auth_view.php', 'template_view.php', $data);

    }
}