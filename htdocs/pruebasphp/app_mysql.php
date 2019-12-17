<?php

	require_once('conexion_BD.php');	

	//mysql_select_db("test_archivos", $conexion) or die ( mysql_error() );

	$query_sql = "SELECT COUNT(id_da) as Cantidad FROM detalle_archivo WHERE id_tp_da = (SELECT id_tpa FROM tipos_archivo WHERE extension = 'xml')";

	$resultado = mysqli_query(db_connect(), $query_sql) or die ( mysql_error () );
	
	if( mysqli_num_rows($resultado) > 0 ) 
	{
		while( $objFila = mysqli_fetch_object($resultado) )
			echo "hay datos " . $objFila->Cantidad. "<br />";
	} else {
		echo "no hay archivos";
	}

?>

