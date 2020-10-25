<?php

require 'models/Pet.php';
require 'models/Client.php';

/**
 * 
 */
class PetController
{

	private $model;
	private $clients;

	public function __construct()
	{
		$this->model = new Pet;
		$this->client = new Client;
	}

	/*public function index()
	{
		$pets = $this->model->getAll();
		require 'views/layouts/main/header.php';
		require 'views/pet/list.php';
		require 'views/layouts/main/footer.php';
	}*/

	public function index()
	{
		require 'views/layouts/pet.search/header.php';
		require 'views/pet/search.php';
		require 'views/layouts/pet.search/footer.php';
	}

	public function new()
	{
		$clients = $this->client->getAll();
		require 'views/pet/new.php';
	}
	public function save()
	{
		$this->model->newPet($_REQUEST);
		header('Location: ?controller=pet');
		
	}
	public function edit()
	{
		if (isset($_REQUEST['idMascota'])) {
			$idMascota = $_REQUEST['idMascota'];
			$data = $this->model->getById($idMascota);
			$clients = $this->client->getAll();
			require 'views/pet/edit.php';
		} else {
			echo "Error, no se realizo";
		}
	}
	public function update()
	{
		if (isset($_POST)) {
			$this->model->editPet($_POST);
			header('Location: ?controller=pet');
		} else {
			echo "Error, no se realizo";
		}
	}
	public function delete()
	{
		$this->model->deletePet($_REQUEST);
		header('Location: ?controller=pet');
	}

	
}
