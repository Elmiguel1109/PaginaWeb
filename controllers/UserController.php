users.validate<?php

require 'models/User.php';
require 'models/Status.php';
require 'models/Rol.php';

/**
 * 
 */
class UserController
{

	private $model;
	private $nombreEstado;
	private $roles;

	public function __construct()
	{
		$this->model = new User;
		$this->nombreEstado = new Status;
		$this->rol = new Rol;
	}


	public function index()
	{
		require 'views/layouts/users.search/header.php';
		require 'views/users/search.php';
		require 'views/layouts/users.search/footer.php';
	}

	public function new()
	{
		$roles = $this->rol->getAll();
		require 'views/users/new.php';
	}
	public function save()
	{
		$this->model->newUser($_REQUEST);
		header('Location: ?controller=user');
		
	}
	public function edit()
	{
		if (isset($_REQUEST['idUsuarioEmpleado'])) {
			$idUsuarioEmpleado = $_REQUEST['idUsuarioEmpleado'];
			$data = $this->model->getById($idUsuarioEmpleado);
			$estados = $this->nombreEstado->getAll();
			$roles = $this->rol->getAll();
			require 'views/users/edit.php';
		} else {
			echo "Error, no se realizo";
		}
	}
	public function update()
	{
		if (isset($_POST)) {
			$this->model->editUser($_POST);
			header('Location: ?controller=user');
		} else {
			echo "Error, no se realizo";
		}
	}
	public function delete()
	{
		$this->model->deleteUser($_REQUEST);
		header('Location: ?controller=user');
	}

	
}
