<?php

/**
 * Modelo de perfil del Usuario
 */
class profileUser
{
	private $idUsuarioEmpleado;
	private $nombreUsuario;
	private $numDocumento;
	private $emailUsuarioEmpleado;
	private $edadUsuarioEmpleado;
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
			$strSq2 = "SELECT u.*, u.nombreUsuario as idUsuarioEmpleado FROM usuarioempleado u INNER JOIN numDocumento.u ON  ORDER BY u.idUsuarioEmpleado ASC";
			$query = $this->pdo->select($strSq2);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

