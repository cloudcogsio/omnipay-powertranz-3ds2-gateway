<?php

namespace Omnipay\PowerTranz\Tests\Message\Request;

use Omnipay\PowerTranz\Message\Request\AuthRequest;
use PHPUnit\Framework\TestCase;

class AuthRequestTest extends TestCase
{
    private AuthRequest $request;
    
    protected function setUp(): void
    {
        $this->request = new AuthRequest(
            $this->createMock(\Omnipay\Common\Http\ClientInterface::class),
            $this->createMock(\Symfony\Component\HttpFoundation\Request::class)
        );
    }
    
    public function testGetEndpoint(): void
    {
        $this->request->setTestMode(true);
        
        $reflectionMethod = new \ReflectionMethod(AuthRequest::class, 'getEndpoint');
        $reflectionMethod->setAccessible(true);
        $result = $reflectionMethod->invoke($this->request);
        
        $this->assertEquals('https://staging.ptranz.com/api/spi/Auth', $result);
    }
    
    public function testGetData(): void
    {
        $parameters = [
            'TransactionIdentifier' => '12345',
            'TotalAmount' => 100.00,
            'CurrencyCode' => 'USD',
            'OrderIdentifier' => 'ORDER-123',
            'InvalidParameter' => 'should-be-filtered-out'
        ];
        
        $this->request->initialize($parameters);
        
        $data = $this->request->getData();
        
        $this->assertArrayHasKey('TransactionIdentifier', $data);
        $this->assertArrayHasKey('TotalAmount', $data);
        $this->assertArrayHasKey('CurrencyCode', $data);
        $this->assertArrayHasKey('OrderIdentifier', $data);
        $this->assertArrayNotHasKey('InvalidParameter', $data);
    }
}