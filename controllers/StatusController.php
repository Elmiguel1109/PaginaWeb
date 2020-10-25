<?php
require 'models/Status.php';
/**
 * 
 */
class StatusController
{
    private $model;

    public function __construct()
    {
        $this->model=new Status;
    }

    public function index()
    {
        require 'views/layouts/status.search/header.php';
        require 'views/status/search.php';
        require 'views/layouts/status.search/footer.php';
    }

    public function new()
    {
        require 'views/status/new.php';
    }
    public function save()
    {
        $this->model->newStatus($_REQUEST);
        header('Location: ?controller=status');
    }
    public function edit()
    {
        if(isset($_REQUEST)){
            $idEstado=$_REQUEST['idEstado'];

            $data=$this->model->getById($idEstado);
            require 'views/status/edit.php';
        }else{
            echo "Error, no se realizo.";
        }
    }
    public function update()
    {
        if(isset($_POST)){
            $this->model->editStatus($_POST);
            header('Location: ?controller=status');
        }else{
            echo "Error, no se realizo";
        }
    }
    public function delete()
    {
        $this->model->deleteStatus($_REQUEST);
        header('Location: ?controller=status');
    }
}
?>