<?php

namespace Omnipay\PowerTranz\Schema;

class CaptureRequest extends AbstractSchema
{
    /**
     * Transaction identifier
     * @var string
     */
    public string $TransactionIdentifier;

    /**
     * Total amount to authorize
     * @var float
     */
    public float $TotalAmount;

    /**
     * Tip amount
     * @var float|null
     */
    public ?float $TipAmount;

    /**
     * Tax amount
     * @var float|null
     */
    public ?float $TaxAmount;

    /**
     * CashBackAmount or other amount
     * @var float|null
     */
    public ?float $OtherAmount;

    /**
     * External identifier for the transaction
     * @var string|null
     */
    public ?string $ExternalIdentifier;

    /**
     * Optional external group identifier
     * @var string|null
     */
    public ?string $ExternalGroupIdentifier;
}
