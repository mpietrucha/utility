<?php

namespace Mpietrucha\Utility\Latch\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, mixed>
 */
interface BuilderInterface extends ArrayableInterface
{
    /**
     * Create a new builder instance for the given indicator.
     */
    public static function indicator(string $indicator): static;

    /**
     * Convert the builder configuration to an array.
     *
     * @return array{0: string, 1: \Mpietrucha\Utility\Latch\Contracts\AdapterInterface|null}
     */
    public function toArray(): array;

    /**
     * Set the adapter to use for the latch.
     */
    public function adapter(AdapterInterface $adapter): static;

    /**
     * Build and return the configured latch instance.
     */
    public function build(): LatchInterface;
}
