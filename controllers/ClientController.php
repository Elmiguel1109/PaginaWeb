<?php

require 'models/Client.php';

/**
 * 
 */
class ClientController
{

	private $model;
	private $nombreUsuarioCliente;

	public function __construct()
	{
		$this->model = new Client;

	}

	public function index()
	{
		require 'views/layouts/client.search/header.php';
		require 'views/client/search.php';
		require 'views/layouts/client.search/footer.php';
	}

	public function new()
	{
		require 'views/client/new.php';
	}
	public function buscaRepetido($DocID,$codSer,$conn){
			$sql="SELECT * from cliente 
				where DocumentoDeIdentidad='$DocID' and codigoServicio='$codSer'";
			$result=mysqli_query($conn,$sql);

			if(mysqli_num_rows($result) > 0){
				return 1;
			}else{
				return 0;
			}
		}
	public function save()
	{
		$this->model->newClient($_REQUEST);
		header('Location: ?controller=client');
		
	}
	public function edit()
	{
		if (isset($_REQUEST['idCliente'])) {
			$idCliente = $_REQUEST['idCliente'];
			$data = $this->model->getById($idCliente);
			require 'views/client/edit.php';
		} else {
			echo "Error, no se realizo";
		}
	}
	public function update()
	{
		if (isset($_POST)) {
			$this->model->editClient($_POST);
			header('Location: ?controller=client');
		} else {
			echo "Error, no se realizo";
		}
	}
	public function delete()
	{
		$this->model->deleteClient($_REQUEST);
		header('Location: ?controller=client');
	}

	
}
