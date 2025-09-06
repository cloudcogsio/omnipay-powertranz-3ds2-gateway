<?php

namespace Omnipay\PowerTranz\Tests;

use Omnipay\PowerTranz\Gateway;
use PHPUnit\Framework\TestCase;

class GatewayTest extends TestCase
{
    private Gateway $gateway;
    
    protected function setUp(): void
    {
        $this->gateway = new Gateway();
    }
    
    public function testGetDefaultParameters(): void
    {
        $defaults = $this->gateway->getDefaultParameters();
        $this->assertIsArray($defaults);
        $this->assertArrayHasKey('testMode', $defaults);
    }
    
    public function testCreateRequestObjects(): void
    {
        $this->assertInstanceOf(\Omnipay\PowerTranz\Message\Request\AliveRequest::class, $this->gateway->Alive([]));
        $this->assertInstanceOf(\Omnipay\PowerTranz\Message\Request\AuthRequest::class, $this->gateway->authorize([]));
        $this->assertInstanceOf(\Omnipay\PowerTranz\Message\Request\SaleRequest::class, $this->gateway->purchase([]));
        $this->assertInstanceOf(\Omnipay\PowerTranz\Message\Request\CaptureRequest::class, $this->gateway->capture([]));
        $this->assertInstanceOf(\Omnipay\PowerTranz\Message\Request\RefundRequest::class, $this->gateway->refund([]));
        $this->assertInstanceOf(\Omnipay\PowerTranz\Message\Request\VoidRequest::class, $this->gateway->void([]));
    }
}