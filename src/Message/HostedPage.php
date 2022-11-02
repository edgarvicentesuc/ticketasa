<?php

namespace Omnipay\Ticketasa\Message;

use Omnipay\Ticketasa\Constants;

class HostedPage extends AbstractRequest
{
    const PARAM_SOURCE_HOLDER_NAME = "CardHolderName";
    const PARAM_TOTAL_AMOUNT = 'TotalAmount';
    protected $TransactionDetails = [];

    //const PARAM_TRANSACTION_IDENTIFIER = 'TransactionIdentifier';
    const PARAM_ORDER_IDENTIFIER = 'OrderIdentifier';
    const PARAM_FIRST_NAME = 'FirstName';
    const PARAM_LAST_NAME = 'LastName';
    const PARAM_NOTIFY_URL = 'NotifyResponseURL';
    const PARAM_RETURN_URL = 'ReturnURL';


    public function getData()
    {
        $this->setTransactionDetails();
        $this->setCardDetails();
        $this->setCredentials();
        $this->setUrls();
        $this->setTransaction();

        return $this->data;
    }

    protected function setTransactionDetails()
    {

        $this->TransactionDetails[self::PARAM_ORDER_IDENTIFIER] = $this->getOrderIdentifier();
        $this->TransactionDetails[self::PARAM_TOTAL_AMOUNT] = $this->getAmount();

        $this->validateTransactionDetails();
    }

    protected function validateTransactionDetails()
    {
        $this->data = $this->TransactionDetails;
    }

    protected function setCardDetails()
    {
        $CardDetails = [];
        $CreditCard = $this->getCard();

        $this->data[self::PARAM_FIRST_NAME] = $CreditCard->getFirstName();
        $this->data[self::PARAM_LAST_NAME] = $CreditCard->getLastName();
    }

    protected function setCredentials()
    {
        $this->data[Constants::CONFIG_KEY_PWTID] = $this->getPWTId();
        $this->data[Constants::CONFIG_KEY_PWTPWD] = $this->getPWTPwd();
    }

    protected function setUrls()
    {
        $this->data[self::PARAM_NOTIFY_URL] = $this->getNotifyUrl();
        $this->data[self::PARAM_RETURN_URL] = $this->getReturnUrl();
    }

    protected function setTransaction()
    {
       // print_r("hola");
        $orderNumberPrefix = $this->getOrderNumberPrefix();

        //print_r($this->getTransactionIdB());

       // print_r($this->getTransactionIdB());
        $transactionId = $this->getTransactionId();

      //  print_r($this->getTransactionId());

        if (empty($transactionId) && $this->getOrderNumberAutoGen()) {
            $transactionId = $this->guidv4();
            $orderIdentifier = $transactionId;
        }

        //example TICKET-ASA-000000000001
        if (!empty($orderNumberPrefix) && !empty($transactionId))
            $orderIdentifier = $orderNumberPrefix . "-" . $transactionId;


        //$this->setTransactionId($transactionId);
      //  $this->setOrderIdentifier($orderIdentifier);

      //  $this->data[self::PARAM_TRANSACTION_IDENTIFIER] = $transactionId;
        $this->data[self::PARAM_ORDER_IDENTIFIER] = $orderIdentifier;
    }


    protected function guidv4($data = null)
    {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }


}