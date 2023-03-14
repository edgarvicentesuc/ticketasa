<?php

namespace Omnipay\Ticketasa\Message;

class TransactionStatusResponse extends AbstractResponse
{

    private function returnInfo($str)
    {
        if (isset($this->getJsonContent()[$str]))
            return $this->getJsonContent()[$str];

        return "No content";
    }

    public function isSuccessful()
    {
        if ($this->getStatusCode() == 200 && $this->returnInfo("IsoResponseCode") == "00")
            return true;

        return false;
    }

    public function isPaid()
    {
        return $this->isSuccessful();
    }

    public function getTransactionId()
    {
        return $this->returnInfo("TransactionIdentifier");
    }

    public function getTotalAmount()
    {
        return $this->returnInfo("TotalAmount");
    }

    public function getAuthorizationCode()
    {
        return $this->returnInfo("AuthorizationCode");
    }

    public function getLastCaptureDateTime()
    {
        return $this->returnInfo("OrderSummary")["LastCaptureDateTime"];
    }

    public function getTransactionDateTime()
    {
        return $this->returnInfo("TransactionDateTime");
    }
}