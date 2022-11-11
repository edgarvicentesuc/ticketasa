<?php

namespace Omnipay\Ticketasa;

class Constants {

    const API_STAGING                      = 'https://staging.ptranz.com/api/';
    const API_PRODUCTION                   = 'https://gateway.ptranz.com/api/';
    const SPI_STAGING                      = 'https://staging.ptranz.com/api/spi/';
    const SPI_PRODUCTION                   = 'https://gateway.ptranz.com/api/spi/';
    const DRIVER_NAME                      = "TicketAsa - Payment Gateway";
    const PLATFORM_TA_UAT                  = 'https://ticketasa-cred.mypeopleapps.com/eventix';
    const PLATFORM_TA_PROD                 = 'https://credomatic.ticketasa.gt/eventix';
    const CONFIG_KEY_PWTID                 = 'PWTId';
    const CONFIG_KEY_PWTPWD                = 'PWTpwd';
    const CONFIG_KEY_NOTIFY_URL            = 'notifyURL';
    const CONFIG_KEY_RETURN_URL            = 'returnURL';
    const GATEWAY_ORDER_IDENTIFIER_PREFIX  = 'orderNumberPrefix';
    const GATEWAY_ORDER_IDENTIFIER_AUTOGEN = 'orderNumberAutoGen';
    const GATEWAY_ORDER_IDENTIFIER         = 'orderIdentifier';
    const CONFIG_APPLY_DISCOUNT            = "Discount";
    const CONFIG_TRANSACTION_IDENTIFIER    = "setTransactionId";
    const CONFIG_PASSWORD                  = "PasswordEncrypt";
    const PASSWORD_SUFFLED                 = "peopleapps2021";
    const PREFIX_ORDER                     = "ASA-";
    const PARAM_HTTP_METHOD                = 'HttpMethod';
    //  const CONFIG_KEY_TRANSID = 'PWTId';
}