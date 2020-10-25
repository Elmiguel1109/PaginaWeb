<?php

/**
 * Modelo de Cliente
 */
class Client 
{
	private $idCliente;
	private $nombreUsuarioCliente;
	private $DocumentoDeIdentidad;
	private $contrasenaCliente;
	private $telefonoCliente;
	private $direccionCliente;
	private $codigoServicio;
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
            $strSql = 'SELECT * FROM cliente';
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

	 public function newClient($data)
    {
        try {
            $this->pdo->insert('cliente', $data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
	
	public function editClient($data)
	{
		try {
			$strWhere = 'idCliente=' . $data['idCliente'];
			$this->pdo->update('cliente', $data, $strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	public function deleteClient($data)
	{
		try {
			$strWhere = 'idCliente = ' . $data['idCliente'];
			$this->pdo->delete('cliente', $strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	public function getById($idCliente)
	{
		try {
			$strsql="SELECT * FROM cliente WHERE idCliente = :idCliente";
			$array =['idCliente'=>$idCliente];
			$query=$this->pdo->select($strsql,$array);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}
