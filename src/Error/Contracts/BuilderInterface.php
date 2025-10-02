<?php

namespace Mpietrucha\Utility\Error\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, mixed>
 */
interface BuilderInterface extends ArrayableInterface
{
    public static function adapter(object $adapter): static;

    /**
     * @return array{0: object, 1: bool, 2: mixed}
     */
    public function toArray(): array;

    public function supported(bool $supported): static;

    public function capture(mixed $capturable): static;

    public function build(): HandlerInterface;
}
