<?php

namespace Omnipay\PowerTranz\Message;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\Common\Exception\RuntimeException;
use Omnipay\PowerTranz\Constants;
use Omnipay\PowerTranz\Schema\SchemaTraits;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    use SchemaTraits;

    protected array $commonHeaders = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];

    /**
     * Overriding Omnipay's implementation since we are not (yet) defining setter methods,
     * but we want all parameters passed to be available.
     * Omnipay's implementation will only set a parameter if there is a corresponding 'set' method defined
     * in the class.
     *
     * @param array $parameters
     * @return $this
     * @throws \ReflectionException
     */
    public function initialize(array $parameters = array()) : AbstractRequest
    {
        if (null !== $this->response) {
            throw new RuntimeException('Request cannot be modified after it has been sent!');
        }

        $this->parameters = new ParameterBag($parameters);
        $this->hydrate($parameters, get_called_class());

        return $this;
    }

    /**
     * @param $data
     * @return AbstractResponse
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function sendData($data) : AbstractResponse
    {
        $this->credentialCheck();
        $messageClassName = $this->getMessageClassName();

        $requestBody = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);

        $httpResponse = $this->httpClient->request(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            $this->commonHeaders,
            $requestBody
        );

        if ($httpResponse instanceof \Psr\Http\Message\ResponseInterface) {
            if ($httpResponse->getStatusCode() == 200) {
                $responseClassName = $this->getResponseClassName($messageClassName);

                return $this->response = new $responseClassName($this, $httpResponse);
            }

            $exceptionDetails = implode(",\r\n",[
                "Status Code: ".$httpResponse->getStatusCode(),
                "Reason Phrase: ".$httpResponse->getReasonPhrase(),
                "Request Body: ".$requestBody,
                "Response Body: ".$httpResponse->getBody()->getContents()
            ]);

            throw new InvalidResponseException($exceptionDetails, $httpResponse->getStatusCode());
        }

        throw new InvalidResponseException();
    }

    protected function getResponseClassName(string $messageClassName) : string
    {
        return __NAMESPACE__."\\Response\\".str_replace("Request", "Response", $messageClassName);
    }

    protected function getMessageClassName() : string
    {
        $className = explode("\\",get_called_class());
        return array_pop($className);
    }

    protected function getApiEndpoint() : string
    {
        return ($this->getTestMode()) ? Constants::API_STAGING : Constants::API_PRODUCTION;
    }

    protected function getSpiEndpoint() : string
    {
        return ($this->getTestMode()) ? Constants::SPI_STAGING : Constants::SPI_PRODUCTION;
    }

    protected function credentialCheck() : AbstractRequest {
        if ($this->getPowerTranzCredentialsFlag() === true)
        {
            $this->commonHeaders['PowerTranz-'.Constants::PARAM_POWERTRANZ_ID] = $this->getParameter(Constants::PARAM_POWERTRANZ_ID);
            $this->commonHeaders['PowerTranz-'.Constants::PARAM_POWERTRANZ_PASSWORD] = $this->getParameter(Constants::PARAM_POWERTRANZ_PASSWORD);
        }

        return $this;
    }

    /**
     * Merchant identifier for the merchant’s account with PowerTranz.
     *
     * @param string $id
     * @return AbstractRequest
     */
    public function setPowerTranzId(string $id) : AbstractRequest
    {
        $this->setParameter(Constants::PARAM_POWERTRANZ_ID, $id);
        return $this;
    }

    /**
     * This is the merchant’s unique processing password.
     *
     * @param string $password
     * @return AbstractRequest
     */
    public function setPowerTranzPassword(string $password) : AbstractRequest
    {
        $this->setParameter(Constants::PARAM_POWERTRANZ_PASSWORD, $password);
        return $this;
    }

    /**
     * Indicate if credentials need to be passed with the request
     *
     * @param bool $flag
     * @return $this
     */
    public function setPowerTranzCredentialsFlag(bool $flag) : AbstractRequest
    {
        $this->setParameter(Constants::PARAM_POWERTRANZ_CREDENTIALS_REQUIRED, $flag);
        return $this;
    }

    public function getPowerTranzCredentialsFlag() : bool {
        return $this->getParameter(Constants::PARAM_POWERTRANZ_CREDENTIALS_REQUIRED) ?? true;
    }

    /**
     * Indicate the HTTP Request Method (GET | POST)
     * @param string $method
     * @return $this
     */
    public function setHttpMethod(string $method) : AbstractRequest
    {
        $this->setParameter(Constants::PARAM_HTTP_METHOD, $method);
        return $this;
    }

    public function getHttpMethod() : string {
        return $this->getParameter(Constants::PARAM_HTTP_METHOD) ?? "POST";
    }

    /**
     * Override parent method to ensure returned value is 3 digit string. (Required by FAC).
     * @return string|null
     */
    public function getCurrencyNumeric(): ?string
    {
        $currency = parent::getCurrencyNumeric();
        if (is_string($currency) && strlen($currency) == 2) return "0".$currency;

        return $currency;
    }

    /**
     * Subclasses must return an api or spi endpoint base url by calling either 'getApiEndpoint' or 'getSpiEndpoint'
     * and appending the endpoint name.
     *
     * Ex.
     *  return $this->getSpiEndpoint()."Auth"
     *
     * @return string
     */
    abstract protected function getEndpoint() : string;
}
