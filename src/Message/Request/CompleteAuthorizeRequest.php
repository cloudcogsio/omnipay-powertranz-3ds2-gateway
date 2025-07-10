<?php

namespace Omnipay\PowerTranz\Message\Request;

use Omnipay\Common\Exception\InvalidResponseException;
use Omnipay\PowerTranz\Message\AbstractResponse;
use Omnipay\PowerTranz\Schema\AuthTrait;
use Omnipay\PowerTranz\Support\StatusReason;

class CompleteAuthorizeRequest extends AuthRequest
{
    use AuthTrait;

    public function getData()
    {
        return $this->SpiToken;
    }

    public function getEndpoint(): string
    {
        return $this->getSpiEndpoint()."Payment";
    }

    /**
     * @param $data
     * @return AbstractResponse
     * @throws InvalidResponseException
     * @throws \JsonException
     */
    public function sendData($data): AbstractResponse
    {
        if ($this->merchantDecision())
            return parent::sendData($data);

        return $this->merchantDeniedResponse();
    }

    /**
     * @return AbstractResponse
     */
    protected function merchantDeniedResponse() : AbstractResponse
    {
        $this->Approved = false;

        if (isset($this->RiskManagement->ThreeDSecure->StatusReason))
            $this->ResponseMessage = (StatusReason::lookup($this->RiskManagement->ThreeDSecure->StatusReason)) ?? $this->ResponseMessage;

        // CompleteAuthorizeResponse or CompleteSaleResponse
        $response_class = str_replace('Request', 'Response', get_called_class());

        return new $response_class($this, $this->toArray());
    }

    /**
     * Logic to decide if transaction should be completed by POSTing to SPI Payment
     * @return bool
     */
    protected function merchantDecision() : bool
    {
        $allow = false;

        // Check IsoResponseCode and 3DS Auth Status
        switch ($this->IsoResponseCode)
        {
            // 3DS not supported, we will allow
            case '3D1':
                $allow = true;
                break;

            // 3DS complete
            case '3D0':
                if (isset($this->RiskManagement->ThreeDSecure->AuthenticationStatus) &&
                    in_array($this->RiskManagement->ThreeDSecure->AuthenticationStatus, ["Y", "A"]))
                {
                    $allow = true;
                }
                break;
        }

        return $allow;
    }
}
