<?php
	// Create the soapClient object
	$soapClient = new SoapClient("https://www.bizcurrency1.com/GPWebServiceBeta/IGPWebService1.svc?singleWsdl");
	
	printf("--------------------------\nTypes\n--------------------------\n");
	var_dump($soapClient->__getTypes()); 
	printf("--------------------------\nFunctions\n--------------------------\n");
	var_dump($soapClient->__getFunctions()); 
	