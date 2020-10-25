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

    $query = "SELECT r.*, s.NombreEstado AS idEstadoFK FROM rol r INNER JOIN estado s ON s.idEstado = r.idEstadoFK  WHERE nombreRol NOT LIKE '' ORDER By idRol LIMIT 25";

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
    					<td>Nombre del Rol</td>
    					<td>Estado</td>
                        <td></td>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					<td>".$fila['idRol']."</td>
    					<td>".$fila['nombreRol']."</td>
    					<td>".$fila['idEstadoFK']."</td>
    				";

    	}
    }else{
    	$salida.="<p class='text-center'>No se encontraron datos.</p>.";
    }


    echo $salida;

    $conn->close();



?>