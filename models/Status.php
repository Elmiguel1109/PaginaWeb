<?php

/**
 * modelo del estado
 */
class Status
{
    private $idEstado;
    private $nombreEstado;
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
            $strSql = 'SELECT * FROM estado';
            $query = $this->pdo->select($strSql);
            return $query;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function newStatus($data)
    {
        try {
            $this->pdo->insert('estado', $data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function editStatus($data)
    {
        try {
            $strWhere= 'idEstado='.$data['idEstado'];
            $this->pdo->update('estado',$data,$strWhere);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
    public function deleteStatus($data)
    {
        try{
            $strWhere='idEstado='.$data['idEstado'];
            $this->pdo->delete('estado',$strWhere);
        }catch(PDOException $e){
            die($e->getMessage());
        }

    }
    public function getById($idEstado)
    {
        try{
            $strSql="SELECT * FROM estado WHERE idEstado=:idEstado";
            $array=['idEstado'=>$idEstado];
            $query=$this->pdo->select($strSql,$array);
            return $query;
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
}
