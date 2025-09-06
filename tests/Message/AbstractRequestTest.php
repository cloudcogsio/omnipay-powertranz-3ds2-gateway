<?php

namespace Omnipay\PowerTranz\Tests\Message;

use Omnipay\Common\Http\ClientInterface;
use Omnipay\PowerTranz\Message\AbstractRequest;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class AbstractRequestTest extends TestCase
{
    public function testCredentialCheck(): void
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpRequest = $this->createMock(HttpRequest::class);
        
        $request = $this->getMockForAbstractClass(
            AbstractRequest::class,
            [$httpClient, $httpRequest]
        );
        $request->setPowerTranzId('test-id');
        $request->setPowerTranzPassword('test-password');
        
        $reflectionMethod = new \ReflectionMethod(AbstractRequest::class, 'credentialCheck');
        $reflectionMethod->setAccessible(true);
        $reflectionMethod->invoke($request);
        
        $reflectionProperty = new \ReflectionProperty(AbstractRequest::class, 'commonHeaders');
        $reflectionProperty->setAccessible(true);
        $headers = $reflectionProperty->getValue($request);
        
        $this->assertArrayHasKey('PowerTranz-PowerTranzId', $headers);
        $this->assertArrayHasKey('PowerTranz-PowerTranzPassword', $headers);
        $this->assertEquals('test-id', $headers['PowerTranz-PowerTranzId']);
        $this->assertEquals('test-password', $headers['PowerTranz-PowerTranzPassword']);
    }
    
    public function testGetCurrencyNumeric(): void
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpRequest = $this->createMock(HttpRequest::class);
        
        $request = $this->getMockForAbstractClass(
            AbstractRequest::class,
            [$httpClient, $httpRequest]
        );
        $request->setCurrency('USD');
        
        $reflectionMethod = new \ReflectionMethod(AbstractRequest::class, 'getCurrencyNumeric');
        $reflectionMethod->setAccessible(true);
        $result = $reflectionMethod->invoke($request);
        
        // USD numeric code is 840
        $this->assertEquals('840', $result);
        
        // Test padding for 2-digit codes
        $request->setCurrency('JPY');
        $result = $reflectionMethod->invoke($request);
        // JPY numeric code is 392
        $this->assertEquals('392', $result);
    }
    
    public function testGetResponseClassName(): void
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpRequest = $this->createMock(HttpRequest::class);
        
        $request = $this->getMockForAbstractClass(
            AbstractRequest::class,
            [$httpClient, $httpRequest]
        );
        
        $reflectionMethod = new \ReflectionMethod(AbstractRequest::class, 'getResponseClassName');
        $reflectionMethod->setAccessible(true);
        $result = $reflectionMethod->invoke($request, 'AuthRequest');
        
        $this->assertEquals('Omnipay\PowerTranz\Message\Response\AuthResponse', $result);
    }
    
    public function testGetApiEndpoint(): void
    {
        $httpClient = $this->createMock(ClientInterface::class);
        $httpRequest = $this->createMock(HttpRequest::class);
        
        $request = $this->getMockForAbstractClass(
            AbstractRequest::class,
            [$httpClient, $httpRequest]
        );
        
        // Test mode on
        $request->setTestMode(true);
        $reflectionMethod = new \ReflectionMethod(AbstractRequest::class, 'getApiEndpoint');
        $reflectionMethod->setAccessible(true);
        $result = $reflectionMethod->invoke($request);
        $this->assertEquals('https://staging.ptranz.com/api/', $result);
        
        // Test mode off
        $request->setTestMode(false);
        $result = $reflectionMethod->invoke($request);
        $this->assertEquals('https://gateway.ptranz.com/api/', $result);
    }
}