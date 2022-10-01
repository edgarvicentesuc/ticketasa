<?php

namespace Omnipay\Ticketasa\Message;

class Authorize extends AbstractRequest
{
    const PARAM_SOURCE_HOLDER_NAME = "CardHolderName";
    const PARAM_TOTAL_AMOUNT = 'TotalAmount';
    protected $TransactionDetails = [];

    const PARAM_TRANSACTION_IDENTIFIER = 'TransactionIdentifier';
    const PARAM_ORDER_IDENTIFIER = 'OrderIdentifier';
    const PARAM_FIRST_NAME = 'FirstName';
    const PARAM_LAST_NAME = 'LastName';

    public function getData()
    {
        $this->setTransactionDetails();
        $this->setCardDetails();

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
        $this->data[self::PARAM_LAST_NAME] =$CreditCard->getLastName();
    }


}