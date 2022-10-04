# Omnipay - TicketAsa 1.0.0

**TicketAsaGT Commerce gateway for the Omnipay PHP payment processing library**

![Packagist License](https://img.shields.io/packagist/l/cloudcogsio/omnipay-firstatlanticcommerce-gateway) ![Packagist Version](https://img.shields.io/packagist/v/cloudcogsio/omnipay-firstatlanticcommerce-gateway) ![Packagist PHP Version Support (specify version)](https://img.shields.io/packagist/php-v/cloudcogsio/omnipay-firstatlanticcommerce-gateway/dev-master) ![GitHub issues](https://img.shields.io/github/issues/cloudcogsio/omnipay-firstatlanticcommerce-gateway) ![GitHub last commit](https://img.shields.io/github/last-commit/cloudcogsio/omnipay-firstatlanticcommerce-gateway)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements TicketAsaGT 2.4 support for Omnipay.

## Installation
Via Composer

``` bash
$ composer require vincsis/omnipay-ticketasa
```
## Gateway Operation Defaults
This gateway driver operates in 3DS mode by default and requires a notify URL to be provided via the '**setNotifyURL**' method.

## Usage
For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay) repository.


### 3DS Transactions (Direct Integration)
'**NotifyURL**' required. URL must be **https://**
``` php

use Omnipay\Omnipay;
try {
    $gateway = Omnipay::create('Ticketasa');
    $gateway
        ->setTestMode(true)  // false to use productions links  , true to use test links 
        ->setPWTId('xxxxxxxx') 
        ->setPWTPwd('xxxxxxxx')
        // **Required and must be https://
        ->setNotifyUrl('https://localhost/webhook.php')
        // *** Autogen an order number  UUID V4
        ->setOrderNumberAutoGen(true)
        // *** redirect to discount form payment or normal form payment
        ->setDiscount(false);
        

    $cardData = [
         'firstName' => 'Gabriel', //optional 
         'LastName' => 'Arzu', // optional
    ];

    $transactionData = [
        'card' => $cardData,
        'amount' => '1.00',   // Mandatory
        ///'TransactionId' => '2100001',  // is mandatory is setOrderNumberAutoGen is false
    ];

    $response = $gateway->purchase($transactionData)->send();


} catch (Exception $e){
    $e->getMessage();
}
```
***webhook response***
Response transaction  from TicketasaGT.
```php
{
  "TransactionType": 1,
  "Approved": true,  // must be true
  "AuthorizationCode": "123456", // Authorization number from bank
  "TransactionIdentifier": "3dbff695-d7e0-4e90-8187-1e93cf13bb40", // Order Number
  "TotalAmount": 1,  //Mount
  "CurrencyCode": "320", 
  "RRN": "227603509881",
  "CardBrand": "Visa",
  "IsoResponseCode": "00", 
  "ResponseMessage": "Transaction is approved", // Message Approvement.
  "OrderIdentifier": "TICKET-ASA-3dbff695-d7e0-4e90-8187-1e93cf13bb40" // Order Identifier PREFIX +  Order Number
}
```

## Support

If you are having general issues with Omnipay, we suggest posting on [Stack Overflow](http://stackoverflow.com/). Be sure to add the [omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/edgarvicentesuc/PowerTranz.git/issues), or better yet, fork the library and submit a pull request.