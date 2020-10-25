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

    $query = "SELECT * FROM cliente  WHERE nombreUsuarioCliente NOT LIKE '' ORDER By idCliente LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM cliente WHERE idCliente LIKE '%$q%' OR nombreUsuarioCliente LIKE '%$q%' OR DocumentoDeIdentidad LIKE '%$q%' OR contrasenaCliente LIKE '%$q%' OR telefonoCliente LIKE '%$q%' OR direccionCliente LIKE '%$q%' OR codigoServicio LIKE '%$q%' ";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="
        <div class='card-body'>
            <a class='m-0 btn btn-primary btn-sm pull-right'  href='?controller=client&method=new'><i class='fas fa-user-plus'></i></a>
        </div>        
            <div class='card-body'>
            <table class='table table-hover'>
    			<thead>
    				<tr id='titulo'>
    					<th>#</th>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Contraseña</th>
                        <th>Telefono</th>
                        <th>Dirección</th>
                        <th>Código</th>
                        <th></th>
                        <th></th>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['idCliente']."</td>
    					<td>".$fila['nombreUsuarioCliente']."</td>
                        <td>".$fila['DocumentoDeIdentidad']."</td>
                        <td>".$fila['contrasenaCliente']."</td>
                        <td>".$fila['telefonoCliente']."</td>
                        <td>".$fila['direccionCliente']."</td>
                        <td>".$fila['codigoServicio']."</td>
                        <td>
                            <a href='?controller=client&method=edit&idCliente=".$fila['idCliente']."' class='btn btn-sm btn-dark'><i class='fas fa-pencil-alt'></i></a>
                        </td>
                        <td>
                            <a href='?controller=client&method=delete&idCliente=".$fila['idCliente']."' class='btn btn-sm btn-danger'><i class='fas fa-trash-alt'></i></a>
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