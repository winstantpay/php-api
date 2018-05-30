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

// Get the UserID from CustomerSettings
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

// Get the AccountId from the balances
$response = $soapClient->CustomerAccountBalancesGet($params);

printf("--------------------------\nWinstantPay WS Response\n--------------------------\n");

// Let's in this example just take the first account to get a statement
// This is actually bad programming but for the sake of clarity there are no range checks here
$accountId = $response->CustomerAccountBalancesGetResult->Balances->CustomerBalanceData[0]->AccountId;
printf("Acount ID is %s\n",$accountId);

 
$params = array(
	"request" => array(
		"ServiceCallerIdentity" => array(
			"LoginId" => $config->username,
			"Password" => $config->password,
			"ServiceCallerId" => $config->callerId
		),
        "AccountId" => $accountId,
        "StartDate" => "2018-01-01",
        "EndDate" => "2018-12-01"
	)
);

// get the account statement
$response = $soapClient->CustomerAccountStatementGetSingle($params);
printf("--------------------------\nWinstantPay WS Response\n--------------------------\n");
var_dump($response);


