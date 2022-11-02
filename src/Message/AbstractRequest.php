<?php

namespace Omnipay\Ticketasa\Message;

use Omnipay\Ticketasa\Exception\InvalidResponseData;
use Omnipay\Ticketasa\Support\Cryptor;
use Omnipay\Ticketasa\Support\ParametersInterface;
use Omnipay\Ticketasa\Constants;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
    implements ParametersInterface
{

    protected $data = [];


    protected $PWTServices = [
        "Payment" => [
            "api" => "normal",
        ],
        "Discount" => [
            "api" => "discount",
        ]
    ];

    public function sendData($data)
    {
        // print_r($this->getTransactionIdB());

        if (!empty($data["NotifyResponseURL"])) {
            if (!empty($data["TransactionIdentifier"])) {

                if (!empty($data["TotalAmount"]) && is_numeric($data["TotalAmount"])) {

                    if (!empty($data[Constants::CONFIG_KEY_PWTID]) && !empty($data[Constants::CONFIG_KEY_PWTPWD])) {

                        return $this->response = new HostedPageResponse($this, $data);

                    } else {
                        throw new InvalidResponseData("PowerTranz Credentials are invalid");
                    }
                } else {
                    throw new InvalidResponseData("Total Amount is not valid");
                }
            } else {
                throw new InvalidResponseData("Transaction Identifier is not valid");
            }
        } else {
            throw new InvalidResponseData("Notify Url is not valid");
        }
    }

    public function setPWTId($PWTID)
    {
        return $this->setParameter(Constants::CONFIG_KEY_PWTID, $PWTID);
    }

    public function getPWTId()
    {
        return $this->getParameter(Constants::CONFIG_KEY_PWTID);
    }

    public function setPWTPwd($PWD)
    {
        return $this->setParameter(Constants::CONFIG_KEY_PWTPWD, $PWD);
    }

    public function getPWTPwd()
    {
        return $this->getParameter(Constants::CONFIG_KEY_PWTPWD);
    }


    protected function createQueryParamProtect($data)
    {
        return json_encode($data);
    }

    public function getTransactionIdB()
    {
        print_r($this->getParameter(Constants::CONFIG_TRANSACTION_IDENTIFIER));
        return $this->getParameter(Constants::CONFIG_TRANSACTION_IDENTIFIER);
    }

    public function setTransactionIdB($value)
    {
        //  print_r($value);
        return $this->setParameter(Constants::CONFIG_TRANSACTION_IDENTIFIER, $value);
    }

    public function setOrderIdentifier($value)
    {
        return $this->setParameter(Constants::GATEWAY_ORDER_IDENTIFIER, $value);
    }

    public function getOrderIdentifier()
    {
        return $this->getParameter(Constants::GATEWAY_ORDER_IDENTIFIER);
    }

    public function setOrderNumberPrefix($value)
    {
        return $this->setParameter(Constants::GATEWAY_ORDER_IDENTIFIER_PREFIX, $value);
    }

    public function getOrderNumberPrefix()
    {
        return $this->getParameter(Constants::GATEWAY_ORDER_IDENTIFIER_PREFIX);
    }

    public function setOrderNumberAutoGen($value)
    {
        return $this->setParameter(Constants::GATEWAY_ORDER_IDENTIFIER_AUTOGEN, $value);
    }

    public function getOrderNumberAutoGen()
    {
        return $this->getParameter(Constants::GATEWAY_ORDER_IDENTIFIER_AUTOGEN);
    }


    public function setDiscount($value)
    {
        return $this->setParameter(Constants::CONFIG_APPLY_DISCOUNT, $value);
    }

    public function getDiscount()
    {
        return $this->getParameter(Constants::CONFIG_APPLY_DISCOUNT);
    }

}