<?php
require 'Models/Service.php';
require 'Models/Pet.php';

 
class ServiceController{ 

    private $model;
    private $pets;

    public function __construct()
    {
        $this->model = new Service;
        $this->pet = new Pet;
    }

    public function index(){
        require 'views/layouts/service.search/header.php';
        require 'views/service/search.php';
        require 'views/layouts/service.search/footer.php';
    }

    public function new()
    {
        $pets = $this->pet->getAll();
        require 'views/service/new.php';
    }
    public function save()
    {
        $this->model->newService($_REQUEST);
        header('Location: ?controller=service');
    }
    public function edit()
    {
        if(isset($_REQUEST)){
            $idTipoServicio=$_REQUEST['idTipoServicio'];

            $data=$this->model->getById($idTipoServicio);
            $pets=$this->pet->getAll();
            require 'views/service/edit.php';
        }else{
            echo "Error, no se realizo.";
        }
    }
    public function update()
    {
        if(isset($_POST)){
            $this->model->editService($_POST);
            header('Location: ?controller=Service');
        }else{
            echo "Error, no se realizo";
        }
    }
    public function delete()
    {
        $this->model->deleteService($_REQUEST);
        header('Location: ?controller=service');
    }
}
?>
       
 }
