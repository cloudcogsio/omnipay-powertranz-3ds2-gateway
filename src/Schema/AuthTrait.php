<?php

namespace Omnipay\PowerTranz\Schema;

trait AuthTrait
{
    /**
     * Auth = 1, Sale = 2, Capture = 3, Void = 4, Refund = 5, Credit = 6
     * @var int
     */
    public int $TransactionType;

    /**
     * Whether or not the authorization was approved
     * @var bool
     */
    public bool $Approved;

    /**
     * Authorization code
     * @var string|null
     */
    public ?string $AuthorizationCode;

    /**
     * Transaction identifier
     * @var string|null
     */
    public ?string $TransactionIdentifier;

    /**
     * Approved total amount
     * @var float|null
     */
    public ?float $TotalAmount;

    /**
     * Currency code
     * @var string|null
     */
    public ?string $CurrencyCode;

    /**
     * Retrieval Reference Number
     * @var string|null
     */
    public ?string $RRN;

    /**
     * Host Retrieval Reference Number
     * @var string|null
     */
    public ?string $HostRRN;

    /**
     * Brand of the card used
     * @var string|null
     */
    public ?string $CardBrand;

    /**
     * Standard ISO response code
     * @var string|null
     */
    public ?string $IsoResponseCode;

    /**
     * Issuer authentication data for EMV purposes; used with the EMV card
     * @var string|null
     */
    public ?string $EmvIssuerAuthenticationData;

    /**
     * Issuer scripts for EMV purposes; executed against the EMV card
     * @var string|null
     */
    public ?string $EmvIssuerScripts;

    /**
     * Authorization Response Code in response EMV data
     * @var string|null
     */
    public ?string $EmvResponseCode;

    /**
     * Response message
     * @var string|null
     */
    public ?string $ResponseMessage;

    public ?RiskManagementResponse $RiskManagement;
    public ?object $CustomData;
    public ?object $Host;

    /**
     * PowerTranz Token for the Pan
     * @var string|null
     */
    public ?string $PanToken;

    /**
     * External identifier for the transaction
     * @var string|null
     */
    public ?string $ExternalIdentifier;

    /**
     * OrderIdentifier mirrored from request
     * @var string|null
     */
    public ?string $OrderIdentifier;

    public ?array $Errors;

    /**
     * HTML redirect data required for various integration types
     * @var string|null
     */
    public ?string $RedirectData;

    /**
     * Single use integration token
     * @var string|null
     */
    public ?string $SpiToken;

    public ?Address $BillingAddress;
}