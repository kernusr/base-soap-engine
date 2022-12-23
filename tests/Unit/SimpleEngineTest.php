<?php

declare(strict_types=1);

namespace SoapTest\Engine;

use PHPUnit\Framework\TestCase;
use Soap\Engine\Metadata\Metadata;
use Soap\Engine\SimpleEngine;
use Soap\Engine\Transport;
use SoapTest\Engine\Fixtures\DummyTransport;
use SoapTest\Engine\Fixtures\InmemoryMetadata;
use SoapTest\Engine\Fixtures\PassThroughDriver;

final class SimpleEngineTest extends TestCase
{
    private $engine;
    private $metadata;
    private $transport;

    protected function setUp(): void
    {
        $this->engine = new SimpleEngine(
            new PassThroughDriver(
                'request',
                ['object'],
                $this->metadata = new InmemoryMetadata()
            ),
            $this->transport = new DummyTransport('response')
        );
    }


    public function test_it_can_request_soap()
    {
        $response = $this->engine->request('hello', ['world']);
        static::assertSame(['object'], $response);
    }

    public function test_it_can_load_metadata()
    {
        static::assertSame($this->metadata, $this->engine->getMetadata());
    }
}
