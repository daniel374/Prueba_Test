<?php
	
	require_once('conexion_BD.php');
	
	echo ("<h1> Pruebas Reportes de Archivos: </h1>");
	//consulta cantidad de archivos por tipo PDF
	$sql_arch = "select count(detall_arch.id_da) as cantidad_archivos, tp_arch.extension from detalle_archivo detall_arch left join tipos_archivo tp_arch on id_tp_da=id_tpa group by tp_arch.extension;";
	
	$cant_arch = mysqli_query(db_connect(), $sql_arch) or die ( mysqli_error () );
	//var_dump($cant_arch);
	
	//***
	if (!$cant_arch) {
		die('La consulta falló: ' . mysql_error());
	}
	/* obtención de filas en orden inverso */
	echo ("<div><h3 style='color:blue;'> Cantidad archivos de cada Tipo: </h3></div>");
	
	for ($i = mysqli_num_rows($cant_arch) - 1; $i >= 0; $i--) {
		if (!mysqli_data_seek($cant_arch, $i)) {
			echo "No se encuenta la fila $i: " . mysqli_error() . "\n";
			continue;
		}

		if (!($fila = mysqli_fetch_assoc($cant_arch))) {
			continue;
		}

		echo ("<h4>| &nbsp;&nbsp;&nbsp;     " . $fila['cantidad_archivos'] . ' - ' . $fila['extension'] . "&nbsp;&nbsp;|</h4>");
	}

	mysqli_free_result($cant_arch);

	mysqli_close(db_connect());
?>