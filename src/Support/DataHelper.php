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

    /**
     *
     * @param string $alpha - Search string is 2 or 3 character country representation (Eg. CA or CAN)
     * @param bool $alpha2
     * @return string|null
     */
    public static function CountryCode(string $alpha, bool $alpha2 = true) : ?string
    {
        $alpha = trim($alpha);
        try {
            if ($alpha2) return (new ISO3166())->alpha2($alpha)['numeric'];

            return (new ISO3166())->alpha3($alpha)['numeric'];
        } catch (\Exception $e)
        {}

        return null;
    }
}
