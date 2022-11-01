<?php
namespace Omnipay\Ticketasa;

class Constants
{
    const DRIVER_NAME = "TicketAsa - Payment Gateway";
    const PLATFORM_TA_UAT = 'https://ticketasa-cred.mypeopleapps.com/eventix';
    const PLATFORM_TA_PROD = 'https://credomatic.ticketasa.gt/eventix';

    const CONFIG_KEY_PWTID = 'PWTId';
    const CONFIG_KEY_PWTPWD = 'PWTpwd';
    const CONFIG_KEY_NOTIFY_URL = 'notifyURL';
    const CONFIG_KEY_RETURN_URL = 'returnURL';
    const GATEWAY_ORDER_IDENTIFIER_PREFIX = 'orderNumberPrefix';
    const GATEWAY_ORDER_IDENTIFIER_AUTOGEN = 'orderNumberAutoGen';
    const GATEWAY_ORDER_IDENTIFIER = 'orderIdentifier';
    const CONFIG_APPLY_DISCOUNT = "Discount";
    const CONFIG_PASSWORD = "PasswordEncrypt";
    const PASSWORD_SUFFLED= "peopleapps2021";
}