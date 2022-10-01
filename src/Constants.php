<?php
namespace Omnipay\Ticketasa;


class Constants
{
    const DRIVER_NAME = "TicketAsa - Payment Gateway";
    const PLATFORM_TA_UAT = 'https://75ec-2803-d100-e240-9e9-bda6-7c56-ab0a-7837.ngrok.io/platzi/eventix/';
    const PLATFORM_TA_PROD = 'https://{subdomain}.ticketasa.gt/eventix/';

    const CONFIG_KEY_PWTID = 'PWTId';
    const CONFIG_KEY_PWTPWD = 'PWTpwd';
    const CONFIG_KEY_MERCHANT_RESPONSE_URL = 'merchantResponseURL';

    const GATEWAY_ORDER_IDENTIFIER_PREFIX = 'orderNumberPrefix';
    const GATEWAY_ORDER_IDENTIFIER_AUTOGEN = 'orderNumberAutoGen';
    const GATEWAY_ORDER_IDENTIFIER = 'orderIdentifier';

    const USE_DISCOUNT_FORM = "discount_form";

    const CONFIG_KEY_NOTIFY_URL = 'notifyURL';
}