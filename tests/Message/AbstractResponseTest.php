<?php

namespace Omnipay\PowerTranz\Tests\Message;

use Omnipay\PowerTranz\Message\Response\AuthResponse;
use PHPUnit\Framework\TestCase;

class AbstractResponseTest extends TestCase
{
    public function testIsSuccessful(): void
    {
        // Create a request object
        $request = $this->createMock(\Omnipay\PowerTranz\Message\AbstractRequest::class);
        
        // Create a response with successful data
        $responseData = [
            'Approved' => true,
            'TransactionType' => 1  // Auth = 1
        ];
        
        // Create the response directly
        $response = new AuthResponse($request, $responseData);
        
        $this->assertTrue($response->isSuccessful());
    }
    
    public function testIsNotSuccessful(): void
    {
        // Create a request object
        $request = $this->createMock(\Omnipay\PowerTranz\Message\AbstractRequest::class);
        
        // Create a response with failed data
        $responseData = [
            'Approved' => false,
            'TransactionType' => 1  // Auth = 1
        ];
        
        // Create the response directly
        $response = new AuthResponse($request, $responseData);
        
        $this->assertFalse($response->isSuccessful());
    }
    
    public function testIsRedirect(): void
    {
        // Create a request object
        $request = $this->createMock(\Omnipay\PowerTranz\Message\AbstractRequest::class);
        
        // Create a response with redirect data
        $responseData = [
            'RedirectData' => '<form action="https://example.com/3ds" method="post"></form>',
            'TransactionType' => 1  // Auth = 1
        ];
        
        // Create the response directly
        $response = new AuthResponse($request, $responseData);
        
        $this->assertTrue($response->isRedirect());
    }
}