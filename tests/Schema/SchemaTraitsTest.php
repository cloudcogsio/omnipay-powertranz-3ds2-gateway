<?php

namespace Omnipay\PowerTranz\Tests\Schema;

use Omnipay\PowerTranz\Schema\SchemaTraits;
use PHPUnit\Framework\TestCase;

class SchemaTraitsTest extends TestCase
{
    public function testHydrate(): void
    {
        // Create a mock class with declared properties to avoid dynamic property deprecation
        $mockClass = new class {
            use SchemaTraits;

            public string $name;
            public float $value;
        };

        $data = [
            'name' => 'Test Name',
            'value' => 123.45
        ];

        $reflectionMethod = new \ReflectionMethod(get_class($mockClass), 'hydrate');
        $reflectionMethod->setAccessible(true);
        $result = $reflectionMethod->invoke($mockClass, $data, get_class($mockClass));

        $this->assertTrue(property_exists($result, 'name'), 'Object should have property "name"');
        $this->assertTrue(property_exists($result, 'value'), 'Object should have property "value"');
        $this->assertEquals('Test Name', $result->name);
        $this->assertEquals(123.45, $result->value);
    }

    public function testToArray(): void
    {
        $mock = new class {
            use SchemaTraits;

            public string $name = 'Test Name';
            public float $value = 123.45;
            public object $nested;

            public function __construct()
            {
                $this->nested = new class {
                    public string $nestedProperty = 'Nested Value';
                };
            }
        };

        $result = $mock->toArray();

        $this->assertIsArray($result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('value', $result);
        $this->assertArrayHasKey('nested', $result);
        $this->assertEquals('Test Name', $result['name']);
        $this->assertEquals(123.45, $result['value']);
        $this->assertIsArray($result['nested']);
        $this->assertArrayHasKey('nestedProperty', $result['nested']);
        $this->assertEquals('Nested Value', $result['nested']['nestedProperty']);
    }
}