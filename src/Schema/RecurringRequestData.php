<?php

namespace Omnipay\PowerTranz\Schema;

class RecurringRequestData extends AbstractSchema
{
    /**
     * Recurring start date YYYYMMDD
     * @var string|null
     */
    public ?string $StartDate;

    /**
     * Recurring frequency D,W,F,M,B,Q,Y
     * @var string|null
     */
    public ?string $Frequency;

    /**
     * Recurring expiry date YYYYMMDD
     * @var string|null
     */
    public ?string $ExpiryDate;
}
