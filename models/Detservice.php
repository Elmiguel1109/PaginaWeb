<?php

/**
 * Modelo de Rol
 */
class Detservice
{
	private $idDetServicio;
	private $tipoServicio;
	private $fechaServicio;
	private $fechaEntregaServicio;
	private $CodigoServicio;
	private $idUsuarioEmpleadoFK;
	private $idTipoServicioFK;
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
			$strSql = "SELECT ds.*, m.nombreMascota AS idMascotaFK, s.nombre AS idTipoServicioFK, u.nombreUsuario AS idUsuarioEmpleadoFK FROM detservicio ds INNER JOIN mascota m ON m.idMascota = ds.idMascotaFK INNER JOIN tiposervicio s ON s.idTipoServicio = ds.idTipoServicioFK INNER JOIN usuarioempleado u ON u.idUsuarioEmpleado = ds.idUsuarioEmpleadoFK ORDER BY ds.idDetServicio ASC";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	
	public function getById($idDetServicio)
	{
		try {
			$strsql="SELECT * FROM detservicio WHERE idDetServicio = :idDetServicio";
			$array =['idDetServicio'=>$idDetServicio];
			$query=$this->pdo->select($strsql,$array);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function newDetservice($data)
    {
        try {
            $this->pdo->insert('detservicio', $data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function editDetservice($data)
    {
        try {
            $strWhere= 'idDetServicio='.$data['idDetServicio'];
            $this->pdo->update('detservicio',$data,$strWhere);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function deleteDetservice($data)
	{
		try {
			$strWhere = 'idDetServicio = ' . $data['idDetServicio'];
			$this->pdo->delete('detservicio', $strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

}
