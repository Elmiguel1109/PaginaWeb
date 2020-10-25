<?php

/**
 * Modelo de Rol
 */
class Rol
{
	private $idRol;
	private $nombreRol;
	private $idEstadoFK;
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
			$strSql = "SELECT r.*, e.NombreEstado as idEstadoFK FROM rol r INNER JOIN estado e ON e.idEstado = r.idEstadoFK ORDER BY r.idRol ASC";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
	public function getById($idRol)
	{
		try {
			$strsql="SELECT * FROM rol WHERE idRol = :idRol";
			$array =['idRol'=>$idRol];
			$query=$this->pdo->select($strsql,$array);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function editStatus($data)
	{
		try {
			$strWhere = 'idRol =' . $data['idRol'];
			$this->pdo->update('rol', $data, $strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}
