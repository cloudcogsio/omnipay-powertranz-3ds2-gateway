<?php

namespace Omnipay\PowerTranz\Schema;

class AuthRequest extends AbstractSchema
{
    /**
     * Transaction identifier. String representation of a GUID.
     * Max length 36
     * @var string
     */
    public string $TransactionIdentifier;

    /**
     * Total amount to authorize
     * DEC(18,3)
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
     * Currency code ISO 4217
     * @var string
     */
    public string $CurrencyCode;

    /**
     * Local time at transaction initiation hhmmss
     * @var string|null
     */
    public ?string $LocalTime;

    /**
     * Local date at transaction initiation YYYYMMDD
     * @var string|null
     */
    public ?string $LocalDate;

    /**
     * If true, an AVS check will be peformed
     * @var bool
     */
    public bool $AddressVerification;

    /**
     * If true, perform 3DSecure processing with the transaction if present
     * @var bool
     */
    public bool $ThreeDSecure;

    /**
     * If true, a BIN Check is performed with the transaction
     * @var bool|null
     */
    public ?bool $BinCheck;

    /**
     * If true, Fraud Check will be performed with the transaction
     * @var bool|null
     */
    public ?bool $FraudCheck;

    /**
     * If true, this is the first transaction in a recurring series
     * @var bool|null
     */
    public ?bool $RecurringInitial;

    /**
     * If true, this transaction is part of a recurring series
     * @var bool|null
     */
    public ?bool $Recurring;

    /**
     * If true, this transaction is a Card-on-file transaction
     * @var bool|null
     */
    public ?bool $CardOnFile;

    /**
     * If true, perform an account verification
     * @var bool|null
     */
    public ?bool $AccountVerification;

    /**
     * Credit or Debit Source Card Data
     * @var Source
     */
    public Source $Source;

    public ?string $TerminalId;
    public ?string $TerminalCode;
    public ?string $TerminalSerialNumber;

    /**
     * External identifier for the transaction
     * @var string|null
     */
    public ?string $ExternalIdentifier;

    /**
     * External identifier for the transaction's batch
     * @var string|null
     */
    public ?string $ExternalBatchIdentifier;

    /**
     * Optional external group identifier
     * @var string|null
     */
    public ?string $ExternalGroupIdentifier;

    /**
     * Order identifier - Order ID assigned by the merchant
     * @var string|null
     */
    public string $OrderIdentifier;

    public Address $BillingAddress;
    public ?Address $ShippingAddress;

    /**
     * Indicates whether ShippingAddress is the same as BillingAddress
     * @var bool|null
     */
    public ?bool $AddressMatch = false;

    public ExtendedRequestData $ExtendedData;
}
