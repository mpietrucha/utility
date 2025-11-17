<?php

namespace Mpietrucha\Utility\Error\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, mixed>
 */
interface BuilderInterface extends ArrayableInterface
{
    /**
     * Create a new builder instance with the given adapter.
     */
    public static function adapter(object $adapter): static;

    /**
     * Get the builder configuration as an array.
     *
     * @return array{0: object, 1: bool, 2: mixed}
     */
    public function toArray(): array;

    /**
     * Set whether the handler is supported.
     */
    public function supported(bool $supported): static;

    /**
     * Set the capturable value.
     */
    public function capture(mixed $capturable): static;

    /**
     * Build the error handler instance.
     */
    public function build(): HandlerInterface;
}
