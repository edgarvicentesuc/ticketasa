<?php

namespace Omnipay\Ticketasa\Message;

class Authorize extends AbstractRequest
{
    const MESSAGE_PART_TRANSACTION_DETAILS = "TransactionDetails";
    const MESSAGE_PART_SOURCE = "Source";

    const PARAM_SOURCE_HOLDER_NAME = "CardHolderName";
    const PARAM_TOTAL_AMOUNT = 'TotalAmount';
    protected $TransactionDetails = [];

    const PARAM_TRANSACTION_IDENTIFIER = 'TransactionIdentifier';
    const PARAM_ORDER_IDENTIFIER = 'OrderIdentifier';

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

    }

    protected function setCardDetails()
    {
        $CardDetails = [];
        $CreditCard = $this->getCard();
        $CardDetails[self::PARAM_SOURCE_HOLDER_NAME] = $CreditCard->getFirstName() . " " . $CreditCard->getLastName();
    }


}