<?php
namespace Omnipay\PowerTranz\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\PowerTranz\Schema\SchemaTraits;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{
    use SchemaTraits;

    /**
     * @throws \JsonException|\ReflectionException
     */
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);

        if ($data instanceof ResponseInterface)
            $this->decodeGatewayResponse();

        if (is_array($data))
            $this->hydrate($data, get_called_class());
    }

    /**
     * @throws \JsonException
     * @throws \ReflectionException
     */
    protected function decodeGatewayResponse() : AbstractResponse {
        /** @var $httpResponse ResponseInterface */
        $httpResponse = $this->getData();

        $json = $httpResponse->getBody()->getContents();
        $this->data = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        $this->hydrate($this->data, get_called_class());

        return $this;
    }
}
