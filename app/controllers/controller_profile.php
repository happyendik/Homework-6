<?php

class Controller_profile extends Controller
{
    public function __construct()
    {
        $this->model = new Model_profile();
        $this->view = new View();
    }

    public function action_index()
    {
        $this->model->checkAccess(); //404 - если нет доступа

        $this->model->showProfileInformation();
        $data = $this->model->statusModel;
        $this->view->generate('profile_view.php', 'template_view.php', $data);
    }

    public function action_post()
    {
        //$this->model->checkAccess(); //404 - если нет доступа
        $this->model->postHandler();
        $this->model->showProfileInformation();
        $data = $this->model->statusModel;
        $this->view->generate('profile_view.php', 'template_view.php', $data);
    }
}