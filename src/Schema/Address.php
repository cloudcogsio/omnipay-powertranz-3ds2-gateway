<?php

namespace Omnipay\PowerTranz\Schema;

class Address extends AbstractSchema
{
    public ?string $FirstName;
    public ?string $LastName;
    public ?string $Line1;
    public ?string $Line2;
    public ?string $City;
    public ?string $County;

    /**
     * State – if supplied must be the country subdivision code defined in ISO 3166-2.
     * For US addresses only correct abbreviations are allowed valid samples :FL ,CA
     *
     * @var string|null
     */
    public ?string $State;

    /**
     * Postal code or zip code
     * @var string
     */
    public string $PostalCode;

    /**
     * Country code - 3 digit ISO code
     * Must contain valid numeric country code (ISO 3166) Must be supplied if State is populated.
     *
     * @var string
     */
    public string $CountryCode;

    public ?string $EmailAddress;

    /**
     * Valid phone number including country code
     * Valid examples: 35301176543210 35301176543210 01176543210
     * (must include CountryCode)
     *
     * @var string|null
     */
    public ?string $PhoneNumber;
    public ?string $PhoneNumber2;
    public ?string $PhoneNumber3;
}
