<?php

namespace Omnipay\PowerTranz\Message\Response;

use Omnipay\PowerTranz\Schema\AuthResponse as SchemaAuthResponse;

class AuthResponse extends SchemaAuthResponse
{
    use ResponseTraits;

    /**
     * If Approved is 'false' and we have an SPI token, this is a postback with 3DS details, pending merchant decision
     * @return bool
     */
    public function isPending(): bool
    {
        return ($this->Approved === false && isset($this->SpiToken));
    }

    /**
     * Check if the response contains HTML form data, if so, then we need to redirect.
     *
     * @return bool|void
     */
    public function isRedirect()
    {
        if (isset($this->RedirectData)) return true;
    }

    /**
     * Get the HTML form data returned by the gateway
     * @return string|null
     */
    public function getRedirectData() : ?string
    {
        return $this->RedirectData;
    }

    /**
     * Render the HTML form in user browser.
     *
     * @return void
     */
    public function redirect()
    {
        echo $this->getRedirectData();
        exit;
    }
}
