<?php
class ControllerFilelist extends Controller
{
    public $dataArray;
    public function __construct()
    {
        $this->model = new ModelFilelist();
        $this->view = new View();
    }

    public function actionIndex()
    {
        $this->model->checkAccess(); //404 - если нет доступа
        //$data = $this->model->statusModel;
        $data2 = $this->model->showInformationList();
        $this->view->generate('filelist_view.php', 'template_view.php', $data = null, $data2);
    }

    public function actionDelete()
    {
        $this->model->checkAccess(); //404 - если нет доступа
        $this->model->deleteUser($this->actionVar);
        //$data = $this->model->statusModel;
        $data2 = $this->model->showInformationList();
        $this->view->generate('filelist_view.php', 'template_view.php', $data = null, $data2);
    }
}