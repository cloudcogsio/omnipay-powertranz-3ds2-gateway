<?php

namespace Omnipay\PowerTranz\Tests\Integration;

use Omnipay\PowerTranz\Gateway;
use Omnipay\PowerTranz\Message\Response\AuthResponse;
use PHPUnit\Framework\TestCase;

class MockServerTest extends TestCase
{
    private Gateway $gateway;
    
    protected function setUp(): void
    {
        $this->gateway = new Gateway();
        $this->gateway->setTestMode(true);
        $this->gateway->setPowerTranzId('test-id');
        $this->gateway->setPowerTranzPassword('test-password');
    }
    
    public function testSuccessfulAuthorization(): void
    {
        // Create a request object
        $request = $this->gateway->authorize([
            'TransactionIdentifier' => '12345',
            'TotalAmount' => 100.00,
            'CurrencyCode' => 'USD',
            'OrderIdentifier' => 'ORDER-123',
        ]);
        
        // Create a response with successful data
        $responseData = [
            'IsoResponseCode' => '00',
            'ResponseMessage' => 'Approved',
            'TransactionIdentifier' => '12345',
            'ApprovalCode' => 'ABC123',
            'Approved' => true,
            'TransactionType' => 1  // Auth = 1
        ];
        
        // Create the response directly
        $response = new AuthResponse($request, $responseData);
        
        // Test the response
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('00', $response->getCode());
        $this->assertEquals('12345', $response->getTransactionReference());
    }
    
    public function testFailedAuthorization(): void
    {
        // Create a request object
        $request = $this->gateway->authorize([
            'TransactionIdentifier' => '12345',
            'TotalAmount' => 100.00,
            'CurrencyCode' => 'USD',
            'OrderIdentifier' => 'ORDER-123',
        ]);
        
        // Create a response with failed data
        $responseData = [
            'IsoResponseCode' => '05',
            'ResponseMessage' => 'Do not honor',
            'TransactionIdentifier' => '12345',
            'Approved' => false,
            'TransactionType' => 1  // Auth = 1
        ];
        
        // Create the response directly
        $response = new AuthResponse($request, $responseData);
        
        // Test the response
        $this->assertFalse($response->isSuccessful());
        $this->assertEquals('05', $response->getCode());
    }
}