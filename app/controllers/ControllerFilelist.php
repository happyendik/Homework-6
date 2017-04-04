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
        //$data = $this->model->statusModel;
        $data2 = $this->model->showInformationList();
        $this->view->generate('filelist_view.php', 'template_view.php', $data = null, $data2);
    }

    public function actionDelete()
    {
        $this->model->deleteUser($this->actionVar);
        //$data = $this->model->statusModel;
        $data2 = $this->model->showInformationList();
        $this->view->generate('filelist_view.php', 'template_view.php', $data = null, $data2);
    }
}