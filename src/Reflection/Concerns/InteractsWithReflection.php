<?php

namespace Mpietrucha\Utility\Reflection\Concerns;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Normalizer;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Reflection\Contracts\InteractsWithReflectionInterface
 */
trait InteractsWithReflection
{
    use Creatable;

    /**
     * Determine whether the reflected class lacks the specified method.
     */
    final public function doesntHaveMethod(string $method): bool
    {
        return $this->hasMethod($method) |> Normalizer::not(...);
    }

    /**
     * Determine whether the reflected class lacks the specified property.
     */
    final public function doesntHaveProperty(string $property): bool
    {
        return $this->hasProperty($property) |> Normalizer::not(...);
    }
}
