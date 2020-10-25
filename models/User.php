<?php

/**
 * Modelo de Usuario
 */
class User
{
	private $idUsuarioEmpleado;
	private $nombreUsuario;
	private $numDocumento;
	private $contrasenaUsuario;
	private $telefonoUsuarioEmpleado;
	private $direccionUsuarioEmpleado;
	private $emailUsuarioEmpleado;
	private $edadUsuarioEmpleado;
	private $generoUsuarioEmpleado;
	private $fechaNacimiento;
	private $idEstadoFK;
	private $idRolFK;
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
			$strSql = "SELECT u.*, s.NombreEstado as idEstadoFK, r.nombreRol as idRolFK FROM usuarioempleado u INNER JOIN estado s ON s.idEstado = u.idEstadoFK INNER JOIN rol r ON r.idRol = u.idRolFK ORDER BY u.idUsuarioEmpleado ASC;";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function newUser($data)
	{
		try {
			$data['idEstadoFK'] = 1;
			$this->pdo->insert('usuarioempleado', $data);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
	public function editUser($data)
	{
		try {
			$strWhere = 'idUsuarioEmpleado=' . $data['idUsuarioEmpleado'];
			$this->pdo->update('usuarioempleado', $data, $strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	public function deleteUser($data)
	{
		try {
			$strWhere = 'idUsuarioEmpleado = ' . $data['idUsuarioEmpleado'];
			$this->pdo->delete('usuarioempleado', $strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	public function getById($idUsuarioEmpleado)
	{
		try {
			$strsql="SELECT * FROM usuarioempleado WHERE idUsuarioEmpleado = :idUsuarioEmpleado";
			$array =['idUsuarioEmpleado'=>$idUsuarioEmpleado];
			$query=$this->pdo->select($strsql,$array);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}
