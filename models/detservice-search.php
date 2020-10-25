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

    $query = "SELECT ds.*, m.nombreMascota AS idMascotaFK, s.nombre AS idTipoServicioFK, u.nombreUsuario AS idUsuarioEmpleadoFK FROM detservicio ds INNER JOIN mascota m ON m.idMascota = ds.idMascotaFK INNER JOIN tiposervicio s ON s.idTipoServicio = ds.idTipoServicioFK INNER JOIN usuarioempleado u ON u.idUsuarioEmpleado = ds.idUsuarioEmpleadoFK WHERE tipoServicio NOT LIKE '' ORDER By idDetServicio LIMIT 25";

    if (isset($_POST['consulta'])) {
        $q = $conn->real_escape_string($_POST['consulta']);
        $query = "SELECT ds.*, m.nombreMascota AS idMascotaFK, s.nombre AS idTipoServicioFK, u.nombreUsuario AS idUsuarioEmpleadoFK FROM detservicio ds INNER JOIN mascota m ON m.idMascota = ds.idMascotaFK INNER JOIN tiposervicio s ON s.idTipoServicio = ds.idTipoServicioFK INNER JOIN usuarioempleado u ON u.idUsuarioEmpleado = ds.idUsuarioEmpleadoFK WHERE idDetServicio LIKE '%$q%' OR tipoServicio LIKE '%$q%' OR fechaServicio LIKE '%$q%' OR fechaEntregaServicio LIKE '%$q%' OR CodigoServicio LIKE '%$q%' OR m.nombreMascota LIKE '%$q%' OR s.nombre LIKE '%$q%' OR u.nombreUsuario LIKE '%$q%' ";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="
        <div class='card-body'>
            <a class='m-0 btn btn-primary text-center btn-sm pull-right'  href='?controller=detservice&method=new'><i class='fas fa-user-plus'></i></a>
        </div>
        <div class='card-body'>
            <table class='table table-hover'>
    			<thead>
    				<tr id='titulo'>
    					<th>#</th>
                            <th>Tipo de servicio</th>
                            <th>Fecha</th>
                            <th>Fecha de entrega</th>
                            <th>Código</th>
                            <th>Empleado</th>
                            <th>Servicio</th>
                            <th>Mascota</th>
                            <th></th>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['idDetServicio']."</td>
    					<td>".$fila['tipoServicio']."</td>
    					<td>".$fila['fechaServicio']."</td>
                        <td>".$fila['fechaEntregaServicio']."</td>
                        <td>".$fila['CodigoServicio']."</td>
                        <td>".$fila['idUsuarioEmpleadoFK']."</td>
                        <td>".$fila['idTipoServicioFK']."</td>
                        <td>".$fila['idMascotaFK']."</td>
                        <td>
                            <div class='btn-group'>
                                <a href='?controller=detservice&method=edit&idDetServicio=".$fila['idDetServicio']."' class='btn btn-sm btn-dark'><i class='fas fa-pencil-alt'></i></a>
                                <a href='?controller=detservice&method=delete&idDetServicio=".$fila['idDetServicio']."' class='btn btn-sm btn-danger'><i class='fas fa-trash-alt'></i></a>
                            </div>
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