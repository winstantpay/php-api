<?php
// Create the soapClient object
$soapClient = new SoapClient("https://www.bizcurrency1.com/GPWebServiceBeta/IGPWebService1.svc?singleWsdl");

$params = [];
$response = $soapClient->GetLibraryVersion($params);
printf("--------------------------\nWinstantPay WS Response\n--------------------------\n");
var_dump($response);