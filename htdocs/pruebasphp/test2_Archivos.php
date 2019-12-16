 <?php
 
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
	$response = $clienteSOAP->BuscarArchivo($aParametros); var_dump($response);
	

	//Invocamos a una función del cliente, devolverá el resultado en formato array.
	
	//$valor = $client->nombre_funcion($aParametros);

	  //Puedes usar un printr($valor) para ver el contenido del array multidimensional
	  //Aquí tienes un ejemplo de cómo acceder a un valor concreto dentro del array    
	
	//$localizador=$value->nombre_de_la_clave_del_array;
	  //A continuación podrás continuar con tu código PHP o invocar más funciones SOAP        
	

?>