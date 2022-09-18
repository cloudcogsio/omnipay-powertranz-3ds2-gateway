<?php

namespace Omnipay\PowerTranz\Message\Request;

use Omnipay\PowerTranz\Message\AbstractRequest;
use Omnipay\PowerTranz\Schema\AuthRequest as SchemaAuthRequest;

class AuthRequest extends AbstractRequest
{
    const ENDPOINT = 'Auth';

    /**
     * @inheritDoc
     */
    protected function getEndpoint(): string
    {
        return $this->getSpiEndpoint().self::ENDPOINT;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return array_intersect_key($this->parameters->all(), array_flip(SchemaAuthRequest::getSchemaProperties()));
    }
}
