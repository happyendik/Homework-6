<?php

class ControllerProfile extends Controller
{
    public function __construct()
    {
        $this->model = new ModelProfile();
        $this->view = new View();
    }

    public function actionIndex()
    {
        $this->model->checkAccess(); //404 - если нет доступа
        //$this->model->checkProfileImage();
        $this->model->showProfileInformation();
        //$data = $this->model->statusModel;
        $this->view->generate('profile_view.php', 'template_view.php');
    }

    public function actionPost()
    {
        $this->model->checkAccess(); //404 - если нет доступа
        $this->model->postHandler();
        $this->model->showProfileInformation();
        $data = $this->model->statusModel;
        $this->view->generate('profile_view.php', 'template_view.php', $data);
    }
}