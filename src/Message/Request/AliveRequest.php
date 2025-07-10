<?php

namespace Omnipay\PowerTranz\Message\Request;

use Omnipay\PowerTranz\Message\AbstractRequest;

class AliveRequest extends AbstractRequest
{
    const ENDPOINT = 'Alive';

    public function getData(): null
    {
        return null;
    }

    protected function getEndpoint(): string
    {
        return $this->getApiEndpoint().self::ENDPOINT;
    }

}
