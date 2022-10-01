<?php

namespace Omnipay\Ticketasa\Message;


class Payment3DS extends Authorize
{
    const PARAM_NOTIFY_URL = "notifyResponseURL";

    public function getData()
    {
        parent::getData();
        $this->applyNotifyResponseURL();

        return $this->data;
    }



    protected function applyNotifyResponseURL()
    {
        $this->data[ucfirst(self::PARAM_NOTIFY_URL)] = $this->getNotifyUrl();
    }
}