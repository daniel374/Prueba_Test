<?php
	
	require_once('conexion_BD.php');
	
	echo ("<h1> Pruebas Reportes de Archivos: </h1>");
	//consulta cantidad de archivos por tipo PDF
	$sql_pdf = "select count(detall_arch.id_da) as cantidad_archivos_pdf from detalle_archivo detall_arch left join tipos_archivo tp_arch on id_tp_da=id_tpa where tp_arch.extension = 'pdf';";
	$sql_xml  = "select count(detall_arch.id_da) as cantidad_archivos_xml from detalle_archivo detall_arch left join tipos_archivo tp_arch on id_tp_da=id_tpa where tp_arch.extension = 'xml';";
	
	$cant_pdf = mysqli_query(db_connect(), $sql_pdf) or die ( mysql_error () );
	
	$row_pdf = mysqli_fetch_assoc($cant_pdf);
	if ($row_pdf) {
		echo ("<div><h1 style='color:blue;'> Cantidad archivos PDF: </h1></div>");
		echo ("<h1><br>&nbsp;&nbsp;&nbsp;     ". $row_pdf['cantidad_archivos_pdf'] . "</h1>");
	} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error(db_connect());
	}
	
	//***
	$cant_xml = mysqli_query(db_connect(), $sql_xml) or die ( mysql_error () );
	
	$row_xml = mysqli_fetch_assoc($cant_xml);
	if ($row_xml) {
		echo ("<h1 style='color:blue;'> Cantidad archivos XML: </h1>");
		echo ("<h1><p> &nbsp;&nbsp;&nbsp;". $row_xml['cantidad_archivos_xml'] . "</p></h1>");
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error(db_connect());
	}
	
	mysqli_close(db_connect());
?>