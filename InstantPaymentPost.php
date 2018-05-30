<?php
define('BASE_DIR', dirname(__FILE__));
$config = include(BASE_DIR . '/config.php');

//Create the soapClient object
$soapClient = new SoapClient("https://www.bizcurrency1.com/GPWebServiceBeta/IGPWebService1.svc?singleWsdl");

// Create a payment
$params = array(
	"request" => array(
		"ServiceCallerIdentity" => array(
			"LoginId" => $config->username,
			"Password" => $config->password,
			"ServiceCallerId" => $config->callerId
		),
        "FromCustomer" => "RALF",
        "ToCustomer" => "HERVE",
        "Amount" => 10.000,
        "CurrencyCode" => "THB",
        "ValueDate" => "",
        "ReasonForPayment" =>"",
        "ExternalReference" => "",
        "Memo" =>""
    )
);

$response = $soapClient->InstantPaymentCreate($params);
$paymentId = $response->InstantPaymentCreateResult->PaymentInformation->PaymentId;
printf("Payment id is %s\n",$paymentId);

// Post (transact) the payment created above
$params = array(
	"request" => array(
		"ServiceCallerIdentity" => array(
			"LoginId" => $config->username,
			"Password" => $config->password,
			"ServiceCallerId" => $config->callerId
		),
        "InstantPaymentId" =>  $paymentId
    )
);

$response = $soapClient->InstantPaymentPost($params);
printf("--------------------------\nWinstantPay WS Response\n--------------------------\n");
var_dump($response);

