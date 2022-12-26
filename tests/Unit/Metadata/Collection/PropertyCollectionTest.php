<?php

declare(strict_types=1);

namespace SoapTest\Engine\Metadata\Collection;

use PHPUnit\Framework\TestCase;
use Soap\Engine\Metadata\Collection\PropertyCollection;
use Soap\Engine\Metadata\Model\Property;
use Soap\Engine\Metadata\Model\XsdType;

final class PropertyCollectionTest extends TestCase
{
    private $collection;

    protected function setUp(): void
    {
        $this->collection = new PropertyCollection(
            new Property('hello', XsdType::create('Response'))
        );
    }

    
    public function test_it_can_iterate_over_properties(): void
    {
        static::assertCount(1, $this->collection);
        $collection = [];
        foreach ($this->collection as $method){
            $collection[] = $method;
        }
        static::assertSame($collection, $this->collection->map(static function($item) {
            return $item;
        }));
    }
}
