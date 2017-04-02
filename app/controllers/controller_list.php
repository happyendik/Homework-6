<?php
class Controller_list extends Controller
{
    public $dataArray;
    public function __construct()
    {
        $this->model = new Model_list();
        $this->view = new View();
    }

    public function action_index()
    {
        $data = $this->model->statusModel;
        $data2 = $this->model->showInformationList();
        $this->view->generate('list_view.php', 'template_view.php', $data, $data2);
    }

    public function action_delete()
    {
        $this->model->deleteUser($this->action_var);
        $data = $this->model->statusModel;
        $data2 = $this->model->showInformationList();
        $this->view->generate('list_view.php', 'template_view.php', $data, $data2);
    }
}