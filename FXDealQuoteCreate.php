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
		)
	)
);
$response = $soapClient->UserSettingsGetSingle($params);
printf("--------------------------\nWinstantPay WS Response\n--------------------------\n");
$userId = $response->UserSettingsGetSingleResult->UserSettings->UserId;
printf("User ID is %s\n",$userId);


// get an FX Deal Quote
$params = array(
	"request" => array(
		"ServiceCallerIdentity" => array(
			"LoginId" => $config->username,
			"Password" => $config->password,
			"ServiceCallerId" => $config->callerId
		),
		"CustomerId" => $userId,
        "BuyCCY" => "MMK",
        "SellCCY" => "THB",
        "Amount" => "1000.00",
        "AmountCCY" => "THB",
        "DealType" => "Spot",
        "IsForCurrencyCalculator" => false
	)
);
// Get the Quote
$response = $soapClient->FXDealQuoteCreate($params);
printf("--------------------------\nWinstantPay WS Response\n--------------------------\n");
var_dump($response);


