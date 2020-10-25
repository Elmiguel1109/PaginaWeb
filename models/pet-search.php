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

    $query = "SELECT m.*, c.nombreUsuarioCliente AS idClienteFK FROM mascota m INNER JOIN cliente c ON c.idCliente = m.idClienteFK  WHERE nombreMascota NOT LIKE '' ORDER By idMascota LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT m.*, c.nombreUsuarioCliente AS idClienteFK FROM mascota m INNER JOIN cliente c ON c.idCliente = m.idClienteFK WHERE idMascota LIKE '%$q%' OR c.nombreUsuarioCliente LIKE '%$q%' OR nombreMascota LIKE '%$q%' OR edadMascota LIKE '%$q%' OR RazaMascota LIKE '%$q%' ";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="
        <div class='card-body'>
            <a class='m-0 btn btn-primary btn-sm pull-right'  href='?controller=pet&method=new'><i class='fas fa-user-plus'></i></a>
        </div>
        <div class='card-body'>
            <table class='table table-hover'>
    			<thead>
    				<tr id='titulo'>
    					<td>#</td>
    					<td>Nombre del cliente</td>
                        <td>Nombre de la mascota</td>
                        <td>Edad</td>
                        <td>Raza</td>
    				</tr>
    			</thead>
                
                <tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['idMascota']."</td>
    					<td>".$fila['idClienteFK']."</td>
                        <td>".$fila['nombreMascota']."</td>
                        <td>".$fila['edadMascota']."</td>
                        <td>".$fila['RazaMascota']."</td>
                <td>
                <a href='?controller=pet&method=edit&idMascota=".$fila['idMascota']."' class='btn btn-sm btn-dark'><i class='fas fa-pencil-alt'></i></a>
                </td>
                <td>
                <a href='?controller=pet&method=delete&idMascota=".$fila['idMascota']."' class='btn btn-sm btn-danger'><i class='fas fa-trash-alt'></i></a>
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