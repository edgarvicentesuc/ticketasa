<?php

namespace Omnipay\Ticketasa\Support;

interface ParametersInterface
{
    public function setPWTId($FACID);

    public function getPWTId();

    public function setPWTPwd($PWD);

    public function getPWTPwd();

    public function setDiscount($value);

    public function getDiscount();
}