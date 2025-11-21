<?php

namespace Mpietrucha\Utility\Error\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<string, string|int>
 *
 * @phpstan-type RawErrorFrame array<string, string|int>
 */
interface FrameInterface extends ArrayableInterface
{
    public function type(): int;

    public function message(): string;

    public function file(): string;

    public function line(): int;
}
