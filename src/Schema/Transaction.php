<?php

namespace Omnipay\PowerTranz\Schema;

class Transaction extends AbstractSchema
{
    public ?string $AuthorizationCode;
    public ?string $AvsResponseCode;
    public ?string $CustomData;
    public ?string $CvvResponseCode;
    public ?string $ExternalBatchIdentifier;
    public ?string $ExternalGroupIdentifier;
    public ?string $ExternalIdentifier;
    public ?string $InternalResultCode;
    public ?string $IsoResponseCode;
    public ?float $OtherAmount;
    public ?float $TaxAmount;
    public ?float $TipAmount;
    public ?float $TotalAmount;
    public ?string $TransactionDateTime;
    public ?string $TransactionIdentifier;
    public ?int $TransactionType;
}
