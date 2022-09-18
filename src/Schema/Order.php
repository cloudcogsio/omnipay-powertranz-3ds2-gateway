<?php

namespace Omnipay\PowerTranz\Schema;

class Order extends AbstractSchema
{
    public ?int $CaptureCount;
    public ?int $CreditCount;
    public ?string $CurrencyCode;
    public ?string $LastCaptureDateTime;
    public ?string $LastCreditDateTime;
    public ?string $OrderIdentifier;
    public ?string $OriginalTrxnDateTime;
    public ?string $OriginalTrxnIdentifier;
    public ?float $SettledAmount;
    public ?float $TotalCaptureAmount;
    public ?float $TotalCreditAmount;
    public ?string $VoidDateTime;
}
