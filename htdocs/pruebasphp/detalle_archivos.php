<?php
	
	require_once('conexion_BD.php');
	
	echo ("<h1> Pruebas Reportes de Archivos: </h1>");
	//consulta cantidad de archivos por tipo PDF
	$sql_del_arch = "SELECT detall_arch.id_da as Id, detall_arch.nombre as Nombre,  tp_arch.extension FROM detalle_archivo detall_arch LEFT JOIN tipos_archivo tp_arch on id_tp_da=id_tpa;";
	
	$detalle_arch = mysqli_query(db_connect(), $sql_del_arch) or die ( mysqli_error () );
	//var_dump($cant_arch);
	
	//***
	if (!$detalle_arch) {
		die('La consulta falló: ' . mysql_error());
	}
	/* obtención de filas en orden inverso */
	echo ("<div><h3 style='color:blue;'> Detalle de los archivos: </h3></div>");
	echo ("<table class='egt'>

			<tr>
				<td><h4 style='color:blue;'>&nbsp;&nbsp;ID&nbsp;&nbsp;</h4></td>
				<td><h4 style='color:blue;'>&nbsp;&nbsp;&nbsp;&nbsp;Nombre&nbsp;&nbsp;</h4></td>
				<td><h4 style='color:blue;'>&nbsp;&nbsp;&nbsp;&nbsp;Extensión</h4></td>

			</tr>
			
			</table>");
			
	for ($i = mysqli_num_rows($detalle_arch) - 1; $i >= 0; $i--) {
		if (!mysqli_data_seek($detalle_arch, $i)) {
			echo "No se encuenta la fila $i: " . mysqli_error() . "\n";
			continue;
		}

		if (!($fila = mysqli_fetch_assoc($detalle_arch))) {
			continue;
		}

		echo ("<table class='egt'>

			<tr>

				<td>" . $fila['Id'] . "</td>
				<td>&nbsp;&nbsp;" . $fila['Nombre'] . "</td>
				<td>&nbsp;&nbsp;" . $fila['extension'] . "</td>

			</tr>

		</table>");
	}

	mysqli_free_result($detalle_arch);

	mysqli_close(db_connect());
?>