<?php

namespace Omnipay\PowerTranz;

/**
 * Version information for the PowerTranz 3DS2 Payment Gateway Driver
 */
class Version
{
    /**
     * Current version of the library
     */
    public const VERSION = '1.0.0';
    
    /**
     * Returns the current version of the library
     *
     * @return string
     */
    public static function getVersion(): string
    {
        return self::VERSION;
    }
}