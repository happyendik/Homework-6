<?php

class Controller_reg extends Controller
{
    public function __construct()
    {
        $this->model = new Model_reg();
        $this->view = new View();
    }

    public function action_index()
    {
        $data = $this->model->statusModel;  // вывод ошибок и замечаний
        $this->view->generate('reg_view.php', 'template_view.php', $data);
    }

    public function action_post()
    {
        $this->model->postHandler();
        $data = $this->model->statusModel;  // вывод ошибок и замечаний
        $this->view->generate('reg_view.php', 'template_view.php', $data);


    }

    public function action_exit()
    {
        if (session_id() != "" || isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 2592000, '/');
            session_destroy();
            //array_push($this->model->statusModel, 'Сессия успешно закрыта');
            header('Location: /reg/index');
            exit();
        }
    }
}