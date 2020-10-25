<?php

/**
 * Modelo Login
 */

class Login
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new Database;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /* 
        $strSql = "SELECT u.*, s.NombreEstado as NombreEstado, r.nombreRol as rol FROM usuarioempleado u INNER JOIN estado s ON s.id = u.status_id INNER JOIN roles r ON r.id = u.role_id WHERE u.email = '{$data['email']}' AND u.password = '{$data['password']}' ";
    */

    public function validateUser($data)
    {
        try {
            $strSql = "SELECT u.*, s.NombreEstado as NombreEstado, r.nombreRol as rol FROM usuarioempleado u INNER JOIN estado s ON s.idEstado = u.idEstadoFK INNER JOIN rol r ON r.idRol = u.idRolFK WHERE u.emailUsuarioEmpleado = '{$data['email']}' AND u.contrasenaUsuario = '{$data['password']}' ";

            $query = $this->pdo->select($strSql);

            if(isset($query[0]->idUsuarioEmpleado)) {
                if($query[0]->idEstadoFK == 1) {
                    $_SESSION['user'] = $query[0];
                    return true;
                } else {
                    return 'Error al Iniciar Sesión. Su Usuario esta Inactivo';
                }
            } else {
                return 'Error al Iniciar Sesión. Verifique sus Credenciales';
            }

        } catch (PDOException $e) {
            return $e->getMessage();
        }    
    }

}
