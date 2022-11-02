<?php


namespace Omnipay\Ticketasa\Message;

class TransactionStatus extends AbstractRequest
{
    const PARAM_IDENTIFIER = 'TransactionIdentifiera';


    protected $TransactionStatus = [];

    public function getData()
    {
        $this->TransactionStatus =

        $this->TransactionStatus[self::PARAM_IDENTIFIER] = $this->getTransactionId();

        $this->data = $this->TransactionStatus;

        return $this->data;
    }
}