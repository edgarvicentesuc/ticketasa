<?php

namespace Omnipay\Ticketasa\Message;

use Omnipay\Ticketasa\Constants;
use Omnipay\Ticketasa\Exception\InvalidResponseData;

class TransactionStatus extends AbstractRequest {

    const PARAM_IDENTIFIER = 'TransactionIdentifier';
    protected $TransactionDetails = [];

    public function getData() {
        $this->TransactionDetails[self::PARAM_IDENTIFIER] = $this->getTransactionId();

        $this->validateTransactionDetails();
        $this->setCredentials();

        return $this->data;
    }

    protected function validateTransactionDetails() {
        if (!empty($this->getTransactionId())) {
            if (!empty($this->getPWTId()) && !empty($this->getPWTPwd())) {

                $this->data = $this->TransactionDetails;
            } else {
                throw new InvalidResponseData("PowerTranz Credentials are invalid");
            }
        } else {
            throw new InvalidResponseData("Transaction Identifier is not valid");
        }
    }

    protected function setCredentials() {
        $this->data[Constants::CONFIG_KEY_PWTID] = $this->getPWTId();
        $this->data[Constants::CONFIG_KEY_PWTPWD] = $this->getPWTPwd();
    }
}