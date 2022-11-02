<?php

namespace Omnipay\Ticketasa;


use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Http\ClientInterface;
use Omnipay\Ticketasa\Support\ParametersInterface;

class Gateway extends AbstractGateway implements ParametersInterface
{

    public function __construct(ClientInterface $httpClient = null, HttpRequest $httpRequest = null)
    {
        parent::__construct(null, $httpRequest);
    }

    public function getName()
    {
        return Constants::DRIVER_NAME;
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function purchase(array $options = []): \Omnipay\Common\Message\AbstractRequest
    {
        return $this->createRequest("\Omnipay\Ticketasa\Message\HostedPage", $options);
    }


    /**
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function fetchTransaction(array $options = []): \Omnipay\Common\Message\AbstractRequest
    {
        return $this->createRequest("\Omnipay\Ticketasa\Message\TransactionStatus", $options);
    }

    public function setNotifyURL($url)
    {
        //$this->setReturnUrl($url);
        return $this->setParameter(Constants::CONFIG_KEY_NOTIFY_URL, $url);
    }

    public function getNotifyURL()
    {
        return $this->getParameter(Constants::CONFIG_KEY_NOTIFY_URL);
    }

    public function setReturnURL($url)
    {
        //$this->setReturnUrl($url);
        return $this->setParameter(Constants::CONFIG_KEY_RETURN_URL, $url);
    }

    public function getReturnURL()
    {
        return $this->getParameter(Constants::CONFIG_KEY_RETURN_URL);
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

    public function getTransactionIdB()
    {
        return $this->getParameter(Constants::CONFIG_TRANSACTION_IDENTIFIER);
    }

    public function setTransactionIdB($ID)
    {
       // print_r($ID);
        return $this->setParameter(Constants::CONFIG_TRANSACTION_IDENTIFIER, $ID);
    }

}