<?php
require 'Models/Rol.php';
require 'Models/Status.php';

 
class RolController{
    private $model;
    private $nombreEstado;

    public function __construct()
    {
        $this->model = new Rol;
        $this->nombreEstado = new Status;
    }

    public function index()
    {
        $roles = $this->model->getAll();
        require 'views/layouts/roles.search/header.php';
        require 'views/roles/list.php';
        require 'views/layouts/roles.search/footer.php';
    }


    public function updateStatus()
    {
        $rol = $this->model->getById($_REQUEST['idRol']);
        $data = [];
        if($rol[0]->idEstadoFK == 1) {
            $data = [
                        'idRol' => $rol[0]->idRol,
                        'idEstadoFK' => 2
                    ];
        } elseif($rol[0]->idEstadoFK == 2) {
            $data = [
                        'idRol' => $rol[0]->idRol,
                        'idEstadoFK' => 1
                    ];
        }
        $this->model->editStatus($data);
        header('Location: ?controller=rol');
    }   
 }
