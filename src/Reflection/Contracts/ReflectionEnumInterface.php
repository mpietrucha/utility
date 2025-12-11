<?php

namespace Mpietrucha\Utility\Reflection\Contracts;

/**
 * @phpstan-require-extends \ReflectionEnum
 */
interface ReflectionEnumInterface extends InteractsWithReflectionInterface
{
    /**
     * @phpstan-assert-if-true null $this->getBackingType()
     *
     * @phpstan-assert-if-false \ReflectionNamedType $this->getBackingType()
     */
    public function isNotBacked(): bool;
}
