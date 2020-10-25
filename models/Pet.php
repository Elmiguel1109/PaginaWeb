<?php

/**
 * Modelo de Usuario
 */
class Pet
{
	private $idMascota;
	private $idClienteFK;
	private $nombreMascota;
	private $edadMascota;
	private $RazaMascota;
	private $pdo;

	public function __construct()
	{
		try {
			$this->pdo = new Database;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function getAll()
	{
		try {
			$strSql = "SELECT m.*, c.nombreUsuarioCliente AS idClienteFK FROM mascota m inner join cliente c on c.idCliente = m.idClienteFK ORDER BY m.idMascota ASC";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function newPet($data)
	{
		try {
			$this->pdo->insert('mascota', $data);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
	public function editPet($data)
	{
		try {
			$strWhere = 'idMascota=' . $data['idMascota'];
			$this->pdo->update('mascota', $data, $strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	public function deletePet($data)
	{
		try {
			$strWhere = 'idMascota = ' . $data['idMascota'];
			$this->pdo->delete('mascota', $strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	public function getById($idMascota)
	{
		try {
			$strsql="SELECT * FROM mascota WHERE idMascota = :idMascota";
			$array =['idMascota'=>$idMascota];
			$query=$this->pdo->select($strsql,$array);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}
