<?php

namespace Omnipay\PowerTranz\Message\Request;

use Omnipay\PowerTranz\Schema\RefundRequest as SchemaRefundRequest;

class RefundRequest extends \Omnipay\PowerTranz\Message\AbstractRequest
{
    const ENDPOINT = 'Refund';

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
        return array_intersect_key($this->parameters->all(), array_flip(SchemaRefundRequest::getSchemaProperties()));
    }
}