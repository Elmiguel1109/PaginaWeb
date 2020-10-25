<?php

/**
 * Modelo de Rol
 */
class Service
{
	private $idTipoServicio;
	private $nombre;
	private $idMascotaFK;
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
			$strSql = "SELECT t.*, m.nombreMascota AS idMascotaFK FROM tipoServicio t INNER JOIN mascota m ON m.idMascota = t.idMascotaFK ORDER BY idTipoServicio ASC;";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
	public function getById($idTipoServicio)
	{
		try {
			$strsql="SELECT * FROM tiposervicio WHERE idTipoServicio = :idTipoServicio";
			$array =['idTipoServicio'=>$idTipoServicio];
			$query=$this->pdo->select($strsql,$array);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function newService($data)
    {
        try {
            $this->pdo->insert('tiposervicio', $data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function editservice($data)
    {
        try {
            $strWhere= 'idTipoServicio='.$data['idTipoServicio'];
            $this->pdo->update('tiposervicio',$data,$strWhere);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function deleteService($data)
	{
		try {
			$strWhere = 'idTipoServicio = ' . $data['idTipoServicio'];
			$this->pdo->delete('tiposervicio', $strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

}
