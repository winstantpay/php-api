
#WinstantPay PHP API

![The WinstantPay Logo](http://www.winstantpay.com/assets/img/logo-winstantpay-L-notag-trans.png "The WinstantPay Logo")

These are the PHP examples for using the WinstantPay webservice API


## Introduction

WinstantPay allows anyone to trade or pay globally with any currency, including cryptos and other tokens anytime and from anywhere. Originating from a foreign currency exchange and trade finance background the WinstantPay core is utilized by WinstantPay to provide a solid means for ecosystem partners to develop mobile and electronic wallets on this platform. 

### Install: ###

1. Install the PHP soap extension (below Ubuntu example).
```bash
 sudo apt-get install php7.2-soap
```
>on ubuntu this should automatically enable the extention. If not simple call 
```php
<?php
	phpinfo();
```
to find out your php.ini file location and enable the soap extension by removing the ";" in front.

2. Clone this repository and execute the example scripts

>Please note that you need a pre-shared key to use the API. 
>We call this key a caller-id.
>
>To get the caller id, you need to complete your KYC (Know Your Client), which will result in >you have a user ID and password with WinstantPay. 
>To complete the basic KYC, you need a working email and telephone number and head over to [WORLD-KYC](https://winstantpay.worldkyc.com/)

>Once done, send us an email to <api@winstantpay.com> from the registered email and we ?will get in touch prompty (usually via SMS to your phone 24hours).
>
>Upon verification of that number we will provide your with the caller ID

After you have all you credentials please follow the following steps (explained in section **Examples** below


### WebService Endpoints ###

You can access the webservice definitions online or through the WSDL file provided as part of this repo in the WSDL subdirectory.
The PHP soap extension offers a convenient way to access the endpoints (aka functions) and types as shown in the example below.

```php
<?php
// Create the soapClient object
$soapClient = new SoapClient("https://www.bizcurrency1.com/GPWebServiceBeta/IGPWebService1.svc?singleWsdl");

printf("--------------------------\nFunctions\n--------------------------\n");
var_dump($soapClient->__getFunctions()); 
printf("--------------------------\nTypes\n--------------------------\n");
var_dump($soapClient->__getTypes()); 
```
## Basic Flow of the API

### Security
Our API foresees that every request has to be authorised and the ServiceCallerIdentity object has to be provided as part of the args object iin very API method call.

```php
"request" => array(
	"ServiceCallerIdentity" => array(
		"LoginId" => $loginId, // from KYC registration
		"Password" => $password, // from KYC registration
		"ServiceCallerId" => $callerid // Upon request via email as describe above
	)
);
```
### Flow

WinstantPay follows in the core the dual controll principle where one user prepares a transaction and a second user (usually a supervisor) approves or books the transaction.
e.g.  
1. InstantPaymentCreate -- returns a PaymentId 
2. InstantPaymentPost -- books the payment

or.

1. UserSettingsGetSingle -- returns the UserId
2. FXDealQouteCreate -- Uses UserId as CustomerId and returns a QuoteId
3. FXDealQuoteBookAndInstantDeposit -- Uses QuoteId and Books the Deal and Depositis it in the users wallet


### Quickstart Example
Each Endpoint is exposed as a function in the PHP soap client. 
The Function you can test to ensure that your environment is setup correct is the GetLibraryVersion endpoint like so:
```php
<?php
// Create the soapClient object
$soapClient = new SoapClient("https://www.bizcurrency1.com/GPWebServiceBeta/IGPWebService1.svc?singleWsdl");

$params = [];
$response = $soapClient->GetLibraryVersion($params);
printf("--------------------------\nWinstantPay WS Response\n--------------------------\n");
var_dump($response);
```
 

>Now that you understand how the general flow works, we hope that  and when in doubt you can browse the WSDL file by using one of the many SOAP toolsets.. 
>We recommend the free community version of [SoapUi](https://www.soapui.org/)  to browse and test our soap API's or use the PHP soapClient explorer introduced above.


## Endpoints

- [CurrencyListGetPaymentCurrencies](#currencylistgetpaymentcurrencies)
- [CustomerAccountBalancesGet](#customeraccountbalancesget)
- [CustomerAccountStatementGetSingle](#customeraccountstatementgetsingle)
- [FXDealQuoteBookAndInstantDeposit](#fxdealquotebookandinstantdeposit)
- [FXDealQuoteCreate](#fxdealquotecreate)
- [GetCustomerAccountBalances](#getcustomeraccountbalances)
- [GetLibraryVersion](#getlibraryversion)
- [InstantPaymentCreate](#instantpaymentcreate)
- [InstantPaymentGetSingle](#instantpaymentgetsingle)
- [InstantPaymentPost](#instantpaymentpost)
- [UserSettingsGetSingle](#usersettingsgetsingle)

### CurrencyListGetPaymentCurrencies
#### Code
```php
<?php
// Create the soapClient object
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
```
#### Response
The Object:
```php
--------------------------
WinstantPay WS Response
--------------------------
object(stdClass)#2 (1) {
  ["CurrencyListGetPaymentCurrenciesResult"]=>
  object(stdClass)#3 (2) {
    ["ServiceResponse"]=>
    object(stdClass)#4 (3) {
      ["HasErrors"]=>
      bool(false)
      ["HasWarnings"]=>
      bool(false)
      ["Responses"]=>
      object(stdClass)#5 (1) {
        ["ServiceResponseData"]=>
        object(stdClass)#6 (6) {
          ["ResponseCode"]=>
          int(0)
          ["ResponseType"]=>
          string(11) "Information"
          ["Message"]=>
          string(7) "Success"
          ["MessageDetails"]=>
          string(30) "Command completed successfully"
          ["FieldName"]=>
          string(0) ""
          ["FieldValue"]=>
          string(0) ""
        }
      }
    }
    ["Currencies"]=>
    object(stdClass)#7 (1) {
      ["CurrencyData"]=>
      array(5) {
        [0]=>
        object(stdClass)#8 (8) {
          ["CurrencyId"]=>
          int(76)
          ["CurrencyCode"]=>
          string(3) "KHR"
          ["CurrencyName"]=>
          string(15) "Cambodian Riels"
          ["CurrencyAmountScale"]=>
          int(2)
          ["CurrencyRateScale"]=>
          int(5)
          ["Symbol"]=>
          string(3) "៛"
          ["PaymentCutoffTime"]=>
          string(5) "16:00"
          ["SettlementDaysToAdd"]=>
          int(0)
        }
        [1]=>
        object(stdClass)#9 (8) {
          ["CurrencyId"]=>
          int(83)
          ["CurrencyCode"]=>
          string(3) "LAK"
          ["CurrencyName"]=>
          string(8) "Lao Kips"
          ["CurrencyAmountScale"]=>
          int(2)
          ["CurrencyRateScale"]=>
          int(5)
          ["Symbol"]=>
          string(3) "₭"
          ["PaymentCutoffTime"]=>
          string(5) "16:00"
          ["SettlementDaysToAdd"]=>
          int(0)
        }
```
### CustomerAccountBalancesGet
This is an example that requires two endpoints to be consumed in sequence:
1. UserSettingsGetSingle to observe the userId
2. CustomerCustomerAccountBalancesGet 
#### Code
```php
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


$userId = $response->UserSettingsGetSingleResult->UserSettings->UserId;

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
	
```
#### Response
The Object (Beginning):
```php
--------------------------
WinstantPay WS Response
--------------------------
object(stdClass)#39 (1) {
  ["CustomerAccountBalancesGetResult"]=>
  object(stdClass)#40 (2) {
    ["ServiceResponse"]=>
    object(stdClass)#41 (3) {
      ["HasErrors"]=>
      bool(false)
      ["HasWarnings"]=>
      bool(false)
      ["Responses"]=>
      object(stdClass)#42 (1) {
        ["ServiceResponseData"]=>
        object(stdClass)#43 (6) {
          ["ResponseCode"]=>
          int(0)
          ["ResponseType"]=>
          string(11) "Information"
          ["Message"]=>
          string(7) "Success"
          ["MessageDetails"]=>
          string(30) "Command completed successfully"
          ["FieldName"]=>
          string(0) ""
          ["FieldValue"]=>
          string(0) ""
        }
      }
    }

```
### CustomerAccountStatementGetSingle
>The remaining web-service calls are described here only. Please refer to the PHP code file with the matching name: CustomerAccountStatementGetSingle.php
This endpoint returns a single account statement

### FXDealQuoteBookAndInstantDeposit
Instant FX transaction. It books a FX deal and instantly deposits the foreign currency to the propper account.

### FXDealQuoteCreate
>Creates an FX deal - Note this is only created and you have a certain amout of time to book it depending on the bank settings

### GetCustomerAccountBalances
This is identical to the [CustomerAccountBalancesGet](#customeraccountbalancesget) endpoint and is listed for historical reasons only.

### GetLibraryVersion
returns the version of the web-service. Please quote this version in any support request you may have.
The version of the time wriring this readme is: 4.5.7.15
>Just use this example to see if your SOAP client is working allright, before you request further support.

### InstantPaymentCreate

### InstantPaymentGetSingle
>Even though the InstantPaymentCreate returns a paymentId, this InstantPaymentGetSingle service depends on a payment that is completed already.
> So this service is called after the InstantPaymentPost function as shown in the example.
### InstantPaymentPost
This endpoint actually transacts the payment in the system and is usually called after the payment has been created with InstantPaymentCreate
>Call the InstantPaymentGetSingle service to get all the details of  the successful payment

### UserSettingsGetSingle
Here you get all the user details, such as account numbers for the user,
> The important field to use from the response is the UserId field. This is used in some suquent calls of the webservice


## To get a wallet 
### KYC first
Head right to the [Demo](https://demo.winstantpay.com/) platform and complete your KYC first.
To complete your KYC you only need a working email address you can access. 
After successful subscription to KYC your user credentials will be added to the system and you can login to the wallet. 
After that, please send us an email so we can creaate a caller-id for you and your all set to go and use this API.


## Wallet Demo

https://demoewallet.winstantpay.com/

## Support

Support for the WinstantPay API is available through the WinstantPay API team. We will share the details about how to interact with our teams at the end of the KYC process.  Should you have pUiany issues before that you can send a twitter message to us to <api@winstantpay.com>

## License

WinstantPay API example scripts are released under the MIT license.

