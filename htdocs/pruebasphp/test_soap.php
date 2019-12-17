<?php

	require_once('lib/nusoap.php');
	
	$endpoint = "http://test.analitica.com.co/AZDigital_Pruebas/WebServices/SOAP/index.php";
	$wsdlFile = "http://test.analitica.com.co/AZDigital_Pruebas/WebServices/ServiciosAZDigital.wsdl";
	
	//CREACIOND EL CLIENTE SOAP/index
	/*$clienteSOAP = new SoapClient($wsdlFile,array(
	'location'=>$endpoint,
	'trace'=>true,
	'exceptions'=>false));*/
	
	// Instancio la clase.
	$oSoapClient = new nusoap_client($endpoint, "wsdl");
	// PARAMETROS
	
	$aParametros = array('[79]' => array("Tipo" => "FechaInicial", "Expresion" => "2019-07-01 00:00:00"));

	$respuesta = $oSoapClient->call("Condicion ", $aParametros);

	if ($oSoapClient->fault)
	{
		echo "Error al llamar el metodo<br/> ".$oSoapClient->getError();
	}
	else
	{
		echo $respuesta;
			echo "Todo fue sin errores";
	} 
	
?>