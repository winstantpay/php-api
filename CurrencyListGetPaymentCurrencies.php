<?php
define('BASE_DIR', dirname(__FILE__));
$config = include(BASE_DIR . '/config.php');

//Create the soapClient object
$soapClient = new SoapClient("https://www.bizcurrency1.com/GPWebServiceBeta/IGPWebService1.svc?singleWsdl");

$params = array(
	"request" => array(
		"ServiceCallerIdentity" => array(
			"LoginId" => $config->username,
			"Password" => $config->password,
			"ServiceCallerId" => $config->callerId
		)
	)
);

$response = $soapClient->CurrencyListGetPaymentCurrencies($params);	
printf("--------------------------\nWinstantPay WS Response\n--------------------------\n");
var_dump($response);	