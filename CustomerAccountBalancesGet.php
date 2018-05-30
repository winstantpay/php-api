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

$response = $soapClient->UserSettingsGetSingle($params);


printf("--------------------------\nWinstantPay WS Response\n--------------------------\n");
$userId = $response->UserSettingsGetSingleResult->UserSettings->UserId;
printf("User ID is %s\n",$userId);

$params = array(
	"request" => array(
		"ServiceCallerIdentity" => array(
			"LoginId" => $config->username,
			"Password" => $config->password,
			"ServiceCallerId" => $config->callerId
		),
		"UserId" => $userId
	)
);

$response = $soapClient->CustomerAccountBalancesGet($params);

printf("--------------------------\nWinstantPay WS Response\n--------------------------\n");
var_dump($response);
