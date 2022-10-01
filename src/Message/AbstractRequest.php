<?php

namespace Omnipay\Ticketasa\Message;

use Omnipay\Ticketasa\Support\ParametersInterface;
use Omnipay\Ticketasa\Constants;
use Omnipay\Ticketasa\Exception\GatewayHTTPException;

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
        print_r("Llego a send data");
        print_r($this-data);

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

    public function getTransactionId()
    {
        $transactionId = parent::getTransactionId();
        $orderIdentifier = parent::getTransactionId();
        $orderNumberPrefix = $this->getOrderNumberPrefix();
//
//        // generate a number random using microtime
        if (empty($transactionId) && $this->getOrderNumberAutoGen() === true) {
            $transactionId = $this->guidv4();
            $orderIdentifier = $transactionId;
        }
//
        //example TICKET-ASA-000000000001
        if (!empty($orderNumberPrefix) && !empty($transactionId))
            $orderIdentifier = $orderNumberPrefix . "-" . $transactionId;


        $this->setTransactionId($transactionId);
        $this->setOrderIdentifier($orderIdentifier);
        $this->setOrderNumberPrefix('');

        return $transactionId;
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

    public function guidv4($data = null)
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