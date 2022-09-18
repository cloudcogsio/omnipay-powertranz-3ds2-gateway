<?php

namespace Omnipay\PowerTranz\Schema;

class ExtendedRequestData extends AbstractSchema
{
    public ?Address $SecondaryAddress;
    public ?object $CustomData;
    public ?object $Level2CustomData;
    public ?object $Level3CustomData;
    public ThreeDSecureRequestData $ThreeDSecure;
    public ?RecurringRequestData $Recurring;
    public ?BrowserInfoData $BrowserInfo;

    /**
     * Url to redirect the cardholder to when then the transaction is complete
     * @var string|null
     */
    public string $MerchantResponseUrl;

    public ?HostedPageRequestData $HostedPage;
}
