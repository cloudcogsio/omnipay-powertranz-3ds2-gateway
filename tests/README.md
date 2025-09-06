# PowerTranz Gateway Tests

This directory contains unit tests for the PowerTranz payment gateway integration.

## Test Structure

- `GatewayTest.php` - Tests for the Gateway class
- `MockHttpClient.php` - Mock HTTP client implementation for testing
- `Message/` - Tests for message classes
  - `AbstractRequestTest.php` - Tests for the AbstractRequest class
  - `AbstractResponseTest.php` - Tests for the AbstractResponse class
  - `Request/` - Tests for specific request classes
    - `AuthRequestTest.php` - Tests for the AuthRequest class
- `Schema/` - Tests for schema classes
  - `SchemaTraitsTest.php` - Tests for the SchemaTraits functionality
- `Integration/` - Integration tests
  - `MockServerTest.php` - Tests with mocked HTTP responses

## Running Tests

To run the tests:

```bash
composer install  # Ensure dependencies are installed
vendor/bin/phpunit
```

## Test Coverage

The tests cover:
- Gateway functionality
- Request and response handling
- Data validation and transformation
- Schema hydration and conversion
- API endpoint determination
- 3D Secure redirect flow