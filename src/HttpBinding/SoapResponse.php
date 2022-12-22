<?php

declare(strict_types=1);

namespace Soap\Engine\HttpBinding;

final class SoapResponse
{
    /**
     * @var string
     */
    private $payload;

    public function __construct(string $payload)
    {
        $this->payload = $payload;
    }

    public function getPayload(): string
    {
        return $this->payload;
    }
}
