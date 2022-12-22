<?php

declare(strict_types=1);

namespace Soap\Engine\HttpBinding;

final class SoapRequest
{
    public const SOAP_1_1 = 1;
    public const SOAP_1_2 = 2;

    /**
     * @var string
     */
    private $request;

    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $action;

    /**
     * @var int
     */
    private $version;

    /**
     * @var bool
     */
    private $oneWay;

    public function __construct(string $request, string $location, string $action, int $version, bool $oneWay = false)
    {
        $this->request = $request;
        $this->location = $location;
        $this->action = $action;
        $this->version = $version;
        $this->oneWay = $oneWay;
    }

    public function getRequest(): string
    {
        return $this->request;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function isSOAP11(): bool
    {
        return $this->getVersion() === self::SOAP_1_1;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function isSOAP12(): bool
    {
        return $this->getVersion() === self::SOAP_1_2;
    }

    public function getOneWay(): bool
    {
        return $this->oneWay;
    }
}
