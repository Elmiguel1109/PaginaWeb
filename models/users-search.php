<?php
	$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "huellitas";

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $conn->query("SET CHARACTER SET utf8");

    $salida = "";

    //$query = "SELECT u.*, s.NombreEstado as idEstadoFK, r.nombreRol as idRolFK FROM usuarioempleado u INNER JOIN estados s ON s.idEstado = u.idEstadoFK INNER JOIN rol r ON r.idRol = u.idRolFK WHERE nombreUsuario NOT LIKE '' ORDER By idUsuarioEmpleado LIMIT 25";

    $query = "SELECT u.*, s.NombreEstado AS idEstadoFK, r.nombreRol AS idRolFK FROM usuarioempleado u INNER JOIN estado s ON s.idEstado = u.idEstadoFK INNER JOIN rol r ON r.idRol = u.idRolFK WHERE nombreUsuario NOT LIKE '' ORDER By idUsuarioEmpleado LIMIT 25";

    /*if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT u.*, s.NombreEstado as idEstadoFK, r.nombreRol as idRolFK FROM usuarioempleado u WHERE idUsuarioEmpleado LIKE '%$q%' OR nombreUsuario LIKE '%$q%' OR numDocumento LIKE '%$q%' OR contraseñaUsuario LIKE '%$q%' OR telefonoUsuarioEmpleado LIKE '%$q%' OR direccionUsuarioEmpleado LIKE '%$q%' OR emailUsuarioEmpleado LIKE '%$q%' OR edadUsuarioEmpleado LIKE '%$q%' OR generoUsuarioEmpleado LIKE '%$q%' OR fechaNacimiento LIKE '%$q%' OR s.NombreEstado LIKE '%$q%' OR r.nombreRol LIKE '%$q%' ";
    }*/

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT u.*, s.NombreEstado AS idEstadoFK, r.nombreRol AS idRolFK FROM usuarioempleado u INNER JOIN estado s ON s.idEstado = u.idEstadoFK INNER JOIN rol r ON r.idRol = u.idRolFK WHERE idUsuarioEmpleado LIKE '%$q%' OR nombreUsuario LIKE '%$q%' OR numDocumento LIKE '%$q%' OR contrasenaUsuario LIKE '%$q%' OR telefonoUsuarioEmpleado LIKE '%$q%' OR direccionUsuarioEmpleado LIKE '%$q%' OR emailUsuarioEmpleado LIKE '%$q%' OR edadUsuarioEmpleado LIKE '%$q%' OR generoUsuarioEmpleado LIKE '%$q%' OR fechaNacimiento LIKE '%$q%' OR s.NombreEstado LIKE '%$q%' OR r.nombreRol LIKE '%$q%' ";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="
        <div class='card-body'>
            <a class='m-0 btn btn-primary text-center btn-sm pull-right'  href='?controller=user&method=new'><i class='fas fa-user-plus'></i></a>
        </div>
        <div class='card-body'>
            <table class='table table-hover'>
    			<thead>
    				<tr id='titulo'>
    					<td>#</td>
    					<td>Estado</td>
    					<th>Rol</th>
                        <th>Nombre</th>
                        <th>Num doc</th>
                        <th>Contraseña</th>
                        <th>Telefono</th>
                        <th>Dirección</th>
                        <th>Email</th>
                        <th>Edad</th>
                        <th>Genero</th>
                        <th>Fecha de nacimiento</th>
                        <th>
                          <a href='?controller=rol' class='btn btn-sm btn-success' style='margin-top: 12px;''><i class='fas fa-user-tag'></i></a>
                        </th>
                        <th>
                          <a href='?controller=status' class='btn btn-sm btn-dark' style='margin-top: 12px;''><i class='fa fa-user-shield'></i></a>
                        </th>
                        <th></th>
                        <th></th>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td style='font-size: 14px;'>".$fila['idUsuarioEmpleado']."</td>
    					<td style='font-size: 14px;'>".$fila['idEstadoFK']."</td>
    					<td style='font-size: 14px;'>".$fila['idRolFK']."</td>
                        <td style='font-size: 14px;'>".$fila['nombreUsuario']."</td>
                        <td style='font-size: 14px;'>".$fila['NumDocumento']."</td>
                        <td style='font-size: 14px;'>".$fila['contrasenaUsuario']."</td>
                        <td style='font-size: 14px;'>".$fila['telefonoUsuarioEmpleado']."</td>
                        <td style='font-size: 14px;'>".$fila['direccionUsuarioEmpleado']."</td>
                        <td style='font-size: 14px;'>".$fila['emailUsuarioEmpleado']."</td>
                        <td style='font-size: 14px;'>".$fila['edadUsuarioEmpleado']."</td>
                        <td style='font-size: 14px;'>".$fila['generoUsuarioEmpleado']."</td>
                        <td style='font-size: 14px;'>".$fila['fechaNacimiento']."</td>
                        <td>
                            <a href='?controller=user&method=edit&idUsuarioEmpleado=".$fila['idUsuarioEmpleado']."' class='btn btn-sm btn-dark'><i class='fas fa-pencil-alt'></i></a>
                        </td>
                        <td>
                            <a href='?controller=user&method=delete&idUsuarioEmpleado=".$fila['idUsuarioEmpleado']."' class='btn btn-sm btn-danger'><i class='fas fa-trash-alt'></i>
                        </td>
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="<p class='text-center'>No se encontraron datos.</p>.";
    }


    echo $salida;

    $conn->close();



?>