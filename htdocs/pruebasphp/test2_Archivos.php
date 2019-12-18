 <?php
 
	set_time_limit(300);
	require_once('conexion_BD.php');
 
	header('Content-Type: text/html; charset=utf-8');
 //Ruta del EndPoint
 
	$endpoint = "http://test.analitica.com.co/AZDigital_Pruebas/WebServices/SOAP/index.php";
	$wsdlFile = "http://test.analitica.com.co/AZDigital_Pruebas/WebServices/ServiciosAZDigital.wsdl"; 

	 //Creación del cliente SOAP
	$clienteSOAP = new SoapClient($wsdlFile,array(
	'location'=>$endpoint,
	'trace'=>true,
	'exceptions'=>false));
	//var_dump($clienteSOAP->__getFunctions()); 
	//var_dump($clienteSOAP->__getTypes());
	
	 
	//Condiciones { Condicion Condicion; }
	//BuscarArchivo { Condiciones Condiciones; string IdUsuarioBusqueda; int IdDirectorioBusqueda; }"
	
	//print_r($clienteSOAP->__getFunctions());
	
	 //Incluye los parámetros que necesites en tu función
	
	$aParametros = array('Condiciones' => array('Condicion' => array('Tipo' => "FechaInicial", 'Expresion' => "2019-07-01 00:00:00")));
	
	//Invocamos a una función del cliente, devolverá el resultado en formato array.
	$response = $clienteSOAP->BuscarArchivo($aParametros); 
	//var_dump($response);
	// ****** Get values stdClass Object PHP ******* //
	// *******Se crea variables que contienen los datos del Archivo
	
	$Id = "";
	$Nombre = "";
	// define mi array que contiene la data de los archivos
	$array_archivo = $response->Archivo;
	foreach ($array_archivo as &$data_archivo) {
		$Id = $data_archivo->Id;
		$Nombre = $data_archivo->Nombre;
		/*
		echo("Nombre del archivo: \r\n\n");
		echo("       " . $Nombre . "\r\n\n");
		echo("Id del archivo: \r\n\n");
		echo("       " . $Id . "\r\n\n");
		*/
		
		//Separacion del tipo documento
		$tipo_archivo = explode(".",$Nombre);
		//echo("tipo archivo: " . $tipo_archivo[1] . "\r\n\n");
		
		foreach ($tipo_archivo as &$valor){
			#Consulta el tipo de archivo no exista:
			//echo (" " . $valor . "\r\n ");  ERROR en strlen($valor)< 4 and strlen($valor)>2 and
			if($valor === end($tipo_archivo)){
				//echo (" exten: " . $valor . "\r\n\n ");
				$query_tp_arch = "SELECT id_tpa FROM tipos_archivo WHERE extension = '" . $valor . "'";

				$res_tp_arch = mysqli_query(db_connect(), $query_tp_arch) or die ( mysql_error () );
				
				$row = mysqli_fetch_assoc($res_tp_arch);
				
				if($row['id_tpa'] > 0){
					//var_dump($res_tp_arch);
					break;
				}else{
					//Se inserta el TIPO DE ARCHIVOS EN LA BD
					$sql = "INSERT INTO tipos_archivo (extension) VALUES ('" . $valor . "')";
					if (mysqli_query(db_connect(), $sql)) {
						  echo "insert tp succesfully";
					} else {
						  echo "Error: " . $sql . "<br>" . mysqli_error(db_connect());
					}
					
					
				}	
			
			}
			
			
		}

		//Inserta el detalle del DOCUMENTO
		$sql = "INSERT INTO detalle_archivo (id_da,nombre,id_tp_da) VALUES (" . $Id . ",'" . $Nombre . "',(SELECT id_tpa FROM tipos_archivo WHERE extension = '" . $valor . "'))";
		if (mysqli_query(db_connect(), $sql)) {
			  echo "insert detalle del archivo succesfully";
		} else {
			  echo "Error: " . $sql . "<br>" . mysqli_error(db_connect());
		}
	
		
	}
	
	mysqli_close(db_connect());


?>