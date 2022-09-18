<?php

namespace Omnipay\PowerTranz\Schema;

/**
 * RiskManagementResponse Model
 */
class RiskManagementResponse extends AbstractSchema
{
    public ?string $AvsResponseCode;
    public ?string $CvvResponseCode;
    public ?ThreeDSecureResponse $ThreeDSecure;
    public ?object $FraudCheck;
}
