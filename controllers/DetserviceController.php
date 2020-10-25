<?php
require 'Models/Detservice.php';
require 'Models/Service.php';
require 'Models/User.php';
require 'Models/Pet.php';

 
class DetserviceController{ 

    private $model;
    private $pets;
    private $services;
    private $users;

    public function __construct()
    {
        $this->model = new Detservice;
        $this->pet = new Pet;
        $this->service = new Service;
        $this->user = new User;
    }

    /*public function index()
    {
        $detservices = $this->model->getAll();
        require 'views/layouts/main/header.php';
        require 'views/detservice/list.php';
        require 'views/layouts/main/footer.php';
    }*/

    public function index()
    {
        require 'views/layouts/detservice.search/header.php';
        require 'views/detservice/search.php';
        require 'views/layouts/detservice.search/footer.php';
    }

    public function new()
    {
        $pets = $this->pet->getAll();
        $services = $this->service->getAll();
        $users = $this->user->getAll();
        require 'views/detservice/new.php';
    }
    public function save()
    {
        $this->model->newDetservice($_REQUEST);
        header('Location: ?controller=detservice');
    }
    public function edit()
    {
        if(isset($_REQUEST)){
            $idDetServicio=$_REQUEST['idDetServicio'];

            $data=$this->model->getById($idDetServicio);
            $pets=$this->pet->getAll();
            $services=$this->service->getAll();
            $users = $this->user->getAll();
            require 'views/detservice/edit.php';
        }else{
            echo "Error, no se realizo.";
        }
    }
    public function update()
    {
        if(isset($_POST)){
            $this->model->editDetservice($_POST);
            header('Location: ?controller=detservice');
        }else{
            echo "Error, no se realizo";
        }
    }
    public function delete()
    {
        $this->model->deleteDetservice($_REQUEST);
        header('Location: ?controller=detservice');
    }
}
?>
       
 }
