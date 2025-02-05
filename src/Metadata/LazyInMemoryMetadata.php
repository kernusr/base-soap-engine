<?php

declare(strict_types=1);

namespace Soap\Engine\Metadata;

use Soap\Engine\Metadata\Collection\MethodCollection;
use Soap\Engine\Metadata\Collection\TypeCollection;

final class LazyInMemoryMetadata implements Metadata
{
    /**
     * @var Metadata
     */
    private $metadata;

    /**
     * @var TypeCollection|null
     */

    private $types = null;

    /**
     * @var MethodCollection|null
     */
    private $methods = null;

    public function __construct(Metadata $metadata)
    {
        $this->metadata = $metadata;
    }

    public function getTypes(): TypeCollection
    {
        if (!$this->types) {
            $this->types = $this->metadata->getTypes();
        }

        return $this->types;
    }

    public function getMethods(): MethodCollection
    {
        if (!$this->methods) {
            $this->methods = $this->metadata->getMethods();
        }

        return $this->methods;
    }
}
