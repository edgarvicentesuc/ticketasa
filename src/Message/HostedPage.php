<?php

namespace Omnipay\Ticketasa\Message;

use Omnipay\Ticketasa\Constants;

class HostedPage extends AbstractRequest
{
    const PARAM_SOURCE_HOLDER_NAME = "CardHolderName";
    const PARAM_TOTAL_AMOUNT = 'TotalAmount';
    protected $TransactionDetails = [];

    const PARAM_TRANSACTION_IDENTIFIER = 'TransactionIdentifier';
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

        return $this->data;
    }

    protected function setTransactionDetails()
    {
        $this->TransactionDetails[self::PARAM_TRANSACTION_IDENTIFIER] = $this->getTransactionId();
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


}