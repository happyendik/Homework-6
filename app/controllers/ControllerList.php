<?php
class ControllerList extends Controller
{
    public $dataArray;
    public function __construct()
    {
        $this->model = new ModelList();
        $this->view = new View();
    }

    public function actionIndex()
    {
        $this->model->checkAccess(); //404 - если нет доступа
        //$data = $this->model->statusModel;
        $data2 = $this->model->showInformationList();
        $this->view->generate('list_view.php', 'template_view.php', $data = null, $data2);
    }

    public function actionDelete()
    {
        $this->model->checkAccess(); //404 - если нет доступа
        $this->model->deleteUser($this->actionVar);
        //$data = $this->model->statusModel;
        $data2 = $this->model->showInformationList();
        $this->view->generate('list_view.php', 'template_view.php', $data = null, $data2);
    }
}