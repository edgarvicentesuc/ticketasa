<?php
/**
 * @author Ricardo Assing (ricardo@tsiana.ca)
 */

namespace Omnipay\Ticketasa\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\AbstractResponse as OmnipayAbstractResponse;
use Omnipay\Ticketasa\Exception\InvalidResponseData;
use Omnipay\Ticketasa\Constants;
use Omnipay\Ticketasa\Support\Cryptor;

abstract class AbstractResponse extends OmnipayAbstractResponse
{
    const AUTHORIZE_CREDIT_CARD_TRANSACTION_RESULTS = "CreditCardTransactionResults";
    const AUTHORIZE_BILLING_DETAILS = "BillingDetails";
    const AUTHORIZE_FRAUD_CONTROL_RESULTS = "FraudControlResults";
    protected $encripted;

    public function __construct(RequestInterface $request, $data)
    {
        print_r($data);
        // $data["TotalAmount"]="asdasdas";


                    $this->request = $request;
                    $this->data = $data;

                    parent::__construct($request, $data);

                    $this->encript($data);
                    // print_r($this->data);


    }

    public function getRequest(): AbstractRequest
    {
        return $this->request;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getEncript()
    {
        return $this->encripted;
    }

    protected function encript($data)
    {
        unset($data[Constants::CONFIG_KEY_PWTID]);
        unset($data[Constants::CONFIG_KEY_PWTPWD]);

        /// print_r($data);

        $this->encripted = Cryptor::encrypt(json_encode($data), $this->data[Constants::CONFIG_KEY_PWTPWD]);
    }


}