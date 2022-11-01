<?php

namespace Omnipay\Ticketasa\Message;

use Omnipay\Ticketasa\Constants;

class HostedPageResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        if (!empty($this->getEncript())) return true;

        return false;
    }


    public function getHostedPageURL()
    {
        if ($this->isSuccessful()) {

            return ($this->request->getTestMode() ? Constants::PLATFORM_TA_UAT : Constants::PLATFORM_TA_PROD)
                . '/' . ($this->request->getDiscount() ? "discount" : "normal") . "?data=" . $this->getEncript();
        }

        return null;
    }

    public function redirectToHostedPage()
    {
        header("Location: " . $this->getHostedPageURL());
        exit;
    }
}