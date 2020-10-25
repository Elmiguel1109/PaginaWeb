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

    $query = "SELECT * FROM estado  WHERE NombreEstado NOT LIKE '' ORDER By idEstado LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM estado WHERE idEstado LIKE '%$q%' OR NombreEstado LIKE '%$q%'";
    }

    $resultado = $conn->query($query);

    if ($resultado->num_rows>0) {
    	$salida.="
        <div class='card-body'>
            <a class='m-0 btn btn-primary btn-sm pull-right'  href='?controller=Status&method=new'><i class='fas fa-user-plus'></i></a>
        </div>
        <div class='card-body'>
            <table class='table table-hover'>
    			<thead>
    				<tr id='titulo'>
    					<td>#</td>
    					<td>Nombre del estado</td>
                        <td></td>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['idEstado']."</td>
    					<td>".$fila['NombreEstado']."</td>
                        <td>
                            <center><a href='?controller=status&method=edit&idEstado=".$fila['idEstado']."' class='btn btn-warning'>Editar</a>
                            <a href='?controller=status&method=delete&idEstado=".$fila['idEstado']."' class='btn btn-danger'>Eliminar</a></center>
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