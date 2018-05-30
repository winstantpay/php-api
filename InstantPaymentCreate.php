<?php
define('BASE_DIR', dirname(__FILE__));
$config = include(BASE_DIR . '/config.php');

//Create the soapClient object
$soapClient = new SoapClient("https://www.bizcurrency1.com/GPWebServiceBeta/IGPWebService1.svc?singleWsdl");

// Get the UserID from CustomerSettings
$params = array(
	"request" => array(
		"ServiceCallerIdentity" => array(
			"LoginId" => $config->username,
			"Password" => $config->password,
			"ServiceCallerId" => $config->callerId
		),
        "FromCustomer" => "RALF",
        "ToCustomer" => "RMP",
        "Amount" => 10.000,
        "CurrencyCode" => "THB",
        "ValueDate" => "",
        "ReasonForPayment" =>"",
        "ExternalReference" => "",
        "Memo" =>""
    )
);
$response = $soapClient->InstantPaymentCreate($params);
printf("--------------------------\nWinstantPay WS Response\n--------------------------\n");
var_dump($response);
