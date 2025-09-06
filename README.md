# PowerTranz 3DS2 Payment Gateway Driver for Omnipay

A PHP library that provides a PowerTranz 3DS2 Payment Gateway Driver for the Omnipay payment processing library.

[![Latest Version](https://img.shields.io/github/v/release/cloudcogsio/omnipay-powertranz-3ds2-gateway?sort=semver)](https://github.com/cloudcogsio/omnipay-powertranz-3ds2-gateway/releases)
[![License](https://img.shields.io/github/license/cloudcogsio/omnipay-powertranz-3ds2-gateway)](https://github.com/cloudcogsio/omnipay-powertranz-3ds2-gateway/blob/main/LICENSE.md)

## Overview

This package implements the [PowerTranz](https://powertranz.com/) payment gateway for the [Omnipay](https://github.com/thephpleague/omnipay) payment processing library, with support for 3D Secure 2.0 (3DS2) transactions.

## Requirements

- PHP 8.x
- ext-json

## Installation

Install the package via Composer:

```bash
composer require cloudcogsio/omnipay-powertranz-3ds2-gateway
```

## Usage

The package follows the Omnipay standard usage pattern:

```php
use Omnipay\PowerTranz\Gateway;

// Initialize the gateway
$gateway = new Gateway();
$gateway->setMerchantId('your-merchant-id');
$gateway->setApiKey('your-api-key');
$gateway->setTestMode(true); // Set to false for production

// Process a payment
$response = $gateway->purchase([
    'amount' => '10.00',
    'currency' => 'USD',
    'card' => $cardDetails,
    // Additional parameters...
])->send();

if ($response->isSuccessful()) {
    // Payment was successful
    $transactionReference = $response->getTransactionReference();
    // Process the successful payment...
} elseif ($response->isRedirect()) {
    // Redirect to 3D Secure
    $response->redirect();
} else {
    // Payment failed
    $errorMessage = $response->getMessage();
    // Handle the error...
}
```

## Supported Methods

The gateway supports the following transaction types:

- `authorize()` - Authorize a payment
- `capture()` - Capture a previously authorized payment
- `purchase()` - Authorize and capture a payment in one step
- `refund()` - Refund a previously captured payment
- `void()` - Void a previously authorized payment
- `completePurchase()` - Complete a 3D Secure purchase

## Project Structure

### Main Components

- `Gateway.php` - The main gateway class that handles transaction requests
- `Message/` - Request and response message handling
  - `Request/` - Transaction request implementations
  - `Response/` - Transaction response implementations
- `Schema/` - Data models and validation
  - Various schema classes for different data structures
  - 3D Secure related schemas
- `Support/` - Helper classes and utilities

## Testing

The package includes a basic test suite. See the [tests/README.md](tests/README.md) file for more information on running tests.

```bash
composer install
vendor/bin/phpunit
```

## Versioning

This package follows [Semantic Versioning](https://semver.org/). 

- MAJOR version for incompatible API changes
- MINOR version for new functionality in a backward compatible manner
- PATCH version for backward compatible bug fixes

For a full list of changes, see the [CHANGELOG.md](CHANGELOG.md) file.

## License

This package is released under the MIT License. See the [LICENSE.md](LICENSE.md) file for details.
