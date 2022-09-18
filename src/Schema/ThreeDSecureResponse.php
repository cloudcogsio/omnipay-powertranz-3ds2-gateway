<?php

namespace Omnipay\PowerTranz\Schema;

/**
 * 3DS Response Model
 */
class ThreeDSecureResponse extends AbstractSchema
{
    /**
     * ECI Indicator
     * @var string|null
     */
    public ?string $Eci;

    /**
     * CAVV Value
     * @var string|null
     */
    public ?string $Cavv;

    /**
     * 3DS Transaction Id
     * @var string|null
     */
    public ?string $Xid;

    /**
     * Authentication Status
     * @var string|null
     */
    public ?string $AuthenticationStatus;

    /**
     * Authentication Status Reason
     * @var string|null
     */
    public ?string $StatusReason;

    /**
     * 3DS redirect form data
     * @var string|null
     */
    public ?string $RedirectData;

    /**
     * 3DS redirect url for the Authentication
     * @var string|null
     */
    public ?string $AuthenticateUrl;

    /**
     * 3DS1 Card enrolled flag
     * @var string|null
     */
    public ?string $CardEnrolled;

    /**
     * 3DS Protocol version
     * @var string|null
     */
    public ?string $ProtocolVersion;

    /**
     * Fingerprint Indicator
     * @var string|null
     */
    public ?string $FingerprintIndicator;

    /**
     * 3DS Directory Server Transaction Id
     * @var string|null
     */
    public ?string $DsTransId;

    /**
     * IsoResponseCode from 3DS portion of an Auth/Sale with 3DS
     * @var string|null
     */
    public ?string $ResponseCode;

    /**
     * Information for the Cardholder from the ACS
     * @var string|null
     */
    public ?string $CardholderInfo;
}
