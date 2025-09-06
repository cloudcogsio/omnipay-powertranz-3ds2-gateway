<?php

namespace Omnipay\PowerTranz;

use Nyholm\Psr7\Response;
use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\PowerTranz\Message\Request\AliveRequest;
use Omnipay\PowerTranz\Message\Request\AuthRequest;
use Omnipay\PowerTranz\Message\Request\CaptureRequest;
use Omnipay\PowerTranz\Message\Request\CompleteAuthorizeRequest;
use Omnipay\PowerTranz\Message\Request\CompleteSaleRequest;
use Omnipay\PowerTranz\Message\Request\RefundRequest;
use Omnipay\PowerTranz\Message\Request\SaleRequest;
use Omnipay\PowerTranz\Message\Request\VoidRequest;

/**
 * @method NotificationInterface acceptNotification(array $options = array())
 * @method RequestInterface fetchTransaction(array $options = [])
 * @method RequestInterface createCard(array $options = array())
 * @method RequestInterface updateCard(array $options = array())
 * @method RequestInterface deleteCard(array $options = array())
 */
class Gateway extends AbstractGateway
{
    /**
     * @return string
     */
    public function getName() : string
    {
        return Constants::DRIVER_NAME;
    }

    public function getDefaultParameters() : array
    {
        return include 'DefaultParameters.php';
    }

    /**
     * returnUrl will be used to capture the 3DS transaction response.
     *
     * It will also configure the MerchantResponseURL option of the gateway which is required by PowerTranz.
     * MerchantResponseURL can be set directly using setMerchantResponseURL($url), but using setReturnUrl($url) is preferred to maintain compatibility with Omnipay.
     *
     * @param string $url
     * @return Gateway
     */
    public function setReturnUrl(string $url): Gateway
    {
        $this->setMerchantResponseURL($url);
        return $this->setParameter("returnUrl", $url);
    }

    /**
     * Alias for setReturnUrl($url)
     *
     * @param string $url
     * @return Gateway
     * @see \Omnipay\PowerTranz\PowerTranzGateway::setReturnUrl();
     */
    public function setMerchantResponseURL(string $url): Gateway
    {
        return $this->setParameter(Constants::PARAM_MERCHANT_RESPONSE_URL, $url);
    }

    /**
     * @return string | NULL
     */
    public function getMerchantResponseURL(): ?string
    {
        return $this->getParameter(Constants::PARAM_MERCHANT_RESPONSE_URL);
    }

    /**
     * Merchant identifier for the merchant’s account with PowerTranz.
     *
     * @param string $id
     * @return Gateway
     */
    public function setPowerTranzId(string $id) : Gateway
    {
        return $this->setParameter(Constants::PARAM_POWERTRANZ_ID, $id);
    }

    /**
     * This is the merchant’s unique processing password.
     *
     * @param string $password
     * @return Gateway
     */
    public function setPowerTranzPassword(string $password) : Gateway
    {
        return $this->setParameter(Constants::PARAM_POWERTRANZ_PASSWORD, $password);
    }

    /**
     * Common logic required for completing an auth or sale
     *
     * @param bool $singlePass
     * @param array $options
     * @return array
     * @throws \JsonException
     * @throws \ReflectionException
     */
    protected function createOptionsForPaymentCompletion(bool $singlePass, array $options = []) : array
    {
        $options[Constants::PARAM_POWERTRANZ_CREDENTIALS_REQUIRED] = false;

        $data = $_POST['Response'];
        $HttpResponse = new Response(http_response_code(), getallheaders(), $data);

        if ($singlePass) {
            $saleRequest = $originalAuthRequest ?? $this->PowerTranzSale(new Schema\SaleRequest([]));
            $Response = new Message\Response\AuthResponse($saleRequest, $HttpResponse);
        } else {
            $authRequest = $originalAuthRequest ?? $this->PowerTranzAuth(new Schema\AuthRequest([]));
            $Response = new Message\Response\AuthResponse($authRequest, $HttpResponse);
        }

        return array_merge($options, $Response->getData());
    }

    /**
     * Gets the status of the Gateway
     *
     * @param array $options
     * @return AbstractRequest
     */
    public function Alive(array $options = [
        Constants::PARAM_POWERTRANZ_CREDENTIALS_REQUIRED => false,
        Constants::PARAM_HTTP_METHOD => 'GET'
    ]) : AbstractRequest
    {
        return $this->createRequest(AliveRequest::class, $options);
    }

    /**
     * Omnipay - Create a sale/purchase request
     *
     * @param array $options
     * @return AbstractRequest
     * @throws \ReflectionException
     */
    public function purchase(array $options = []) : AbstractRequest
    {
        $saleRequest = new Schema\SaleRequest($options);
        return $this->PowerTranzSale($saleRequest);
    }

    /**
     * Used to determine if 'Sale' request should be completed
     *
     * @param array $options
     * @param AbstractRequest|null $originalSaleRequest - initiating Sale request if available can be passed in
     * @return AbstractRequest
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function completePurchase(array $options = [], AbstractRequest $originalSaleRequest = null) : AbstractRequest
    {
        return $this->createRequest(
            CompleteSaleRequest::class,
            $this->createOptionsForPaymentCompletion(true, $options)
        );
    }

    /**
     * Omnipay - Create an authorization request
     * This method proxies to '$Gateway->PowerTranzAuth'
     *
     * @param array $options
     * @return AbstractRequest
     * @throws \ReflectionException
     */
    public function authorize(array $options = []) : AbstractRequest
    {
        $authRequest = new Schema\AuthRequest($options);
        return $this->PowerTranzAuth($authRequest);
    }

    /**
     * Used to determine if 'Auth' request should be completed
     *
     * @param array $options
     * @param AbstractRequest|null $originalAuthRequest - initiating Auth request if available can be passed in
     * @return AbstractRequest
     * @throws \JsonException
     * @throws \ReflectionException
     */
    public function completeAuthorize(array $options = [], AbstractRequest $originalAuthRequest = null) : AbstractRequest
    {
        return $this->createRequest(
            CompleteAuthorizeRequest::class,
            $this->createOptionsForPaymentCompletion(false, $options)
        );
    }

    /**
     * Omnipay - Create a capture request
     * This method proxies to '$Gateway->PowerTranzCapture'
     *
     * @param array $options
     * @return AbstractRequest
     * @throws \ReflectionException
     */
    public function capture(array $options = []) : AbstractRequest
    {
        $captureRequest = new Schema\CaptureRequest($options);
        return $this->PowerTranzCapture($captureRequest);
    }

    /**
     * Omnipay - Create a refund request
     *
     * @param array $options
     * @return AbstractRequest
     * @throws \ReflectionException
     */
    public function refund(array $options = []) : AbstractRequest
    {
        $refundRequest = new Schema\RefundRequest($options);
        return $this->PowerTranzRefund($refundRequest);
    }

    /**
     * Omnipay - Create a void request
     *
     * @param array $options
     * @return AbstractRequest
     * @throws \ReflectionException
     */
    public function void(array $options = []) : AbstractRequest
    {
        $voidRequest = new Schema\VoidRequest($options);
        return $this->PowerTranzVoid($voidRequest);
    }

    /**
     * PowerTranz - Create a purchase/sale request.
     *
     * @param Schema\SaleRequest $saleRequest
     * @return AbstractRequest
     */
    public function PowerTranzSale(Schema\SaleRequest $saleRequest) : AbstractRequest
    {
        return $this->createRequest(SaleRequest::class, $saleRequest->toArray());
    }

    /**
     * PowerTranz - Create an authorization request.
     *
     * @param Schema\AuthRequest $authRequest
     * @return AbstractRequest
     */
    public function PowerTranzAuth(Schema\AuthRequest $authRequest) : AbstractRequest
    {
        return $this->createRequest(AuthRequest::class, $authRequest->toArray());
    }

    /**
     * PowerTranz - Create a capture request
     *
     * @param Schema\CaptureRequest $captureRequest
     * @return AbstractRequest
     */
    public function PowerTranzCapture(Schema\CaptureRequest $captureRequest) : AbstractRequest
    {
        return $this->createRequest(CaptureRequest::class, $captureRequest->toArray());
    }

    /**
     * PowerTranz - Create a refund request
     *
     * @param Schema\RefundRequest $refundRequest
     * @return AbstractRequest
     */
    public function PowerTranzRefund(Schema\RefundRequest $refundRequest) : AbstractRequest
    {
        return $this->createRequest(RefundRequest::class, $refundRequest->toArray());
    }

    /**
     * PowerTranz - Create a void request
     *
     * @param Schema\VoidRequest $voidRequest
     * @return AbstractRequest
     */
    public function PowerTranzVoid(Schema\VoidRequest $voidRequest) : AbstractRequest
    {
        return $this->createRequest(VoidRequest::class, $voidRequest->toArray());
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }
}
