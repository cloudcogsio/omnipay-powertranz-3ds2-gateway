<?php
/**
 * @author Ricardo Assing (ricardo@tsiana.ca)
 * 
 * Some constants used within the project.
 */
namespace Omnipay\PowerTranz;

class Constants
{
    const DRIVER_NAME = 'PowerTranz - 3DS2 Payment Gateway';

    const API_STAGING = 'https://staging.ptranz.com/api/';
    const API_PRODUCTION = 'https://XYZ.ptranz.com/api/';
    const SPI_STAGING = 'https://staging.ptranz.com/api/spi/';
    const SPI_PRODUCTION = 'https://XYZ.ptranz.com/api/spi/';

    const PARAM_MERCHANT_RESPONSE_URL = 'merchantResponseURL';
    const PARAM_POWERTRANZ_ID = 'PowerTranzId';
    const PARAM_POWERTRANZ_PASSWORD = 'PowerTranzPassword';
    const PARAM_POWERTRANZ_CREDENTIALS_REQUIRED = 'PowerTranzCredentialsFlag';
    const PARAM_HTTP_METHOD = 'HttpMethod';
}
