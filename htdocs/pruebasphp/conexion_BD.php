<?php
	function db_connect() {
		$conexion = mysqli_connect("localhost", "root", "Bruno374", "test_archivos") or die ( mysql_error() );
		return $conexion;
	}
?>