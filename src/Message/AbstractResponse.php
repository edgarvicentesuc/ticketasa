<?php
/**
 * @author Ricardo Assing (ricardo@tsiana.ca)
 */

namespace Omnipay\Ticketasa\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\Common\Message\AbstractResponse as OmnipayAbstractResponse;
use Omnipay\Ticketasa\Constants;
use Omnipay\Ticketasa\Support\Cryptor;

abstract class AbstractResponse extends OmnipayAbstractResponse {

    const AUTHORIZE_CREDIT_CARD_TRANSACTION_RESULTS = "CreditCardTransactionResults";
    const AUTHORIZE_BILLING_DETAILS                 = "BillingDetails";
    const AUTHORIZE_FRAUD_CONTROL_RESULTS           = "FraudControlResults";
    protected $encripted;
    protected $jsonContent;

    public function __construct(RequestInterface $request, $data) {
        $this->request = $request;
        $this->data = $data;

        parent::__construct($request, $data);

        switch ($request->getMessageClassName()) {
            case "HostedPage":
                $this->encript($this->data, $this->data[Constants::CONFIG_KEY_PWTPWD]);
                break;
            case "TransactionStatus":
                $this->decodeGatewayResponse($this->data);
                break;
            case "RefundPayment":
                $this->decodeGatewayResponse($this->data);
                break;
            default:
                break;
        }
    }

    public function getRequest(): AbstractRequest {
        return $this->request;
    }

    public function getData() {
        return $this->data;
    }

    public function getEncript() {
        return $this->encripted;
    }

    //new method to save the payload from bank server, parsed to json
    public function getJsonContent() {
        return $this->jsonContent;
    }


    // new method to check the httpcode
    public function getStatusCode() {
        return $this->data->getStatusCode();
    }

    protected function encript($data, $key) {
        unset($data[Constants::CONFIG_KEY_PWTID]);
        unset($data[Constants::CONFIG_KEY_PWTPWD]);
        $this->encripted = Cryptor::encrypt(json_encode($data), $key);
    }

    protected function decodeGatewayResponse($data): AbstractResponse {
       // $httpResponse = $this->getData();

        $json = stripslashes($this->getData()->getBody()->getContents());
        $this->jsonContent = json_decode($json, true, 512, JSON_UNESCAPED_SLASHES);

        return $this;
    }
}