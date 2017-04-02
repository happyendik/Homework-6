<?php
class Controller_filelist extends Controller
{
    public $dataArray;
    public function __construct()
    {
        $this->model = new Model_filelist();
        $this->view = new View();
    }

    public function action_index()
    {
        $data = $this->model->statusModel;
        $data2 = $this->model->showInformationList();
        $this->view->generate('filelist_view.php', 'template_view.php', $data, $data2);
    }

    public function action_delete()
    {
        $this->model->deleteUser($this->action_var);
        $data = $this->model->statusModel;
        $data2 = $this->model->showInformationList();
        $this->view->generate('filelist_view.php', 'template_view.php', $data, $data2);
    }
}