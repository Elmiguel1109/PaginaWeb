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

    $query = "SELECT t.*, m.nombreMascota as idMascotaFK  FROM tiposervicio t INNER JOIN mascota m ON m.idMascota = t.idMascotaFK WHERE nombre NOT LIKE '' ORDER By idTipoServicio LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT t.*, m.nombreMascota as idMascotaFK FROM tiposervicio t INNER JOIN mascota m ON m.idMascota = t.idMascotaFK WHERE idTipoServicio LIKE '%$q%' OR nombre LIKE '%$q%' OR m.nombreMascota LIKE '%$q%' ";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="
        <div class='card-body'>
            <a class='m-0 btn btn-primary btn-sm pull-right'  href='?controller=Service&method=new'><i class='fas fa-user-plus'></i></a>
        </div>
        <div class='card-body'>
            <table class='table table-hover'>
    			<thead>
    				<tr id='titulo'>
    					<td>#</td>
    					<td>Nombre del servicio</td>
    					<td>Nombre de la mascota</td>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['idTipoServicio']."</td>
    					<td>".$fila['nombre']."</td>
    					<td>".$fila['idMascotaFK']."</td>
                        <td>
                            <div class='btn-group'>
                            <!-- ?controller=detservice -->
                                <a href='?controller=detservice' class='btn btn-sm btn-success'><i class='fas fa-cogs'></i></a>
                                <a href='?controller=service&method=edit&idTipoServicio=".$fila['idTipoServicio']."' class='btn btn-sm btn-dark'><i class='fas fa-pencil-alt'></i></a>
                                <a href='?controller=service&method=delete&idTipoServicio=".$fila['idTipoServicio']."' class='btn btn-sm btn-danger'><i class='fas fa-trash-alt'></i></a>
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