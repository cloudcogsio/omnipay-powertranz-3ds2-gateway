<?php

namespace Omnipay\PowerTranz\Support;

use Alcohol\ISO4217;
use League\ISO3166\ISO3166;

class DataHelper
{
    /**
     * Convert 3 character currency to ISO 4217 numeric code
     *
     * @param string $alpha3
     * @return string
     */
    public static function CurrencyCode(string $alpha3) : string
    {
        return (new ISO4217())->getByCode($alpha3)['numeric'];
    }

    public static function CountryCode(string $alpha3) : string
    {
        return (new ISO3166())->alpha3($alpha3)['numeric'];
    }
}
