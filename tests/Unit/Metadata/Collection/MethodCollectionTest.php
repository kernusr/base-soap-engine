<?php

declare(strict_types=1);

namespace SoapTest\Engine\Metadata\Collection;

use PHPUnit\Framework\TestCase;
use Soap\Engine\Exception\MetadataException;
use Soap\Engine\Metadata\Collection\MethodCollection;
use Soap\Engine\Metadata\Collection\ParameterCollection;
use Soap\Engine\Metadata\Model\Method;
use Soap\Engine\Metadata\Model\XsdType;

final class MethodCollectionTest extends TestCase
{
    private $collection;

    protected function setUp(): void
    {
        $this->collection = new MethodCollection(
            new Method('hello', new ParameterCollection(), XsdType::create('Response'))
        );
    }

    
    public function test_it_can_iterate_over_methods(): void
    {
        static::assertCount(1, $this->collection);
        $collection = [];
        foreach ($this->collection as $method) {
            $collection[] = $method;
        }
        static::assertSame($collection, $this->collection->map(static function ($item) {
            return $item;
        }));
    }

    
    public function test_it_can_fetch_by_name(): void
    {
        $method = $this->collection->fetchByName('hello');
        static::assertSame('hello', $method->getName());
    }

    
    public function test_it_can_fail_fetching_by_name(): void
    {
        $this->expectException(MetadataException::class);
        $this->collection->fetchByName('nope');
    }
}
