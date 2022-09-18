<?php

namespace Omnipay\PowerTranz\Message\Request;

use Omnipay\PowerTranz\Schema\VoidRequest as SchemaVoidRequest;

class VoidRequest extends \Omnipay\PowerTranz\Message\AbstractRequest
{
    const ENDPOINT = 'Void';

    /**
     * @inheritDoc
     */
    protected function getEndpoint(): string
    {
        return $this->getApiEndpoint().self::ENDPOINT;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        return array_intersect_key($this->parameters->all(), array_flip(SchemaVoidRequest::getSchemaProperties()));
    }
}