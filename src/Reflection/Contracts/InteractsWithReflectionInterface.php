<?php

namespace Mpietrucha\Utility\Reflection\Contracts;

use Mpietrucha\Utility\Contracts\CreatableInterface;

/**
 * @phpstan-require-extends \ReflectionClass
 */
interface InteractsWithReflectionInterface extends CreatableInterface
{
    /**
     * Determine whether the reflected class lacks the given method.
     */
    public function doesntHaveMethod(string $method): bool;

    /**
     * Determine whether the reflected class lacks the given property.
     */
    public function doesntHaveProperty(string $property): bool;
}
