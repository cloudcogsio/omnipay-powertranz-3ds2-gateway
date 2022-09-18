<?php

namespace Omnipay\PowerTranz\Message\Request;

use Omnipay\PowerTranz\Message\AbstractRequest;
use Omnipay\PowerTranz\Schema\SaleRequest as SchemaSaleRequest;

class SaleRequest extends AbstractRequest
{
    const ENDPOINT = 'Sale';

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
        return array_intersect_key($this->parameters->all(), array_flip(SchemaSaleRequest::getSchemaProperties()));
    }
}
