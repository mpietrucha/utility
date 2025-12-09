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
    /**
     * Get the error type from the frame.
     */
    public function type(): int;

    /**
     * Get the error level from the frame.
     */
    public function level(): int;

    /**
     * Get the error message from the frame.
     */
    public function message(): string;

    /**
     * Get the file path from the frame.
     */
    public function file(): string;

    /**
     * Get the line number from the frame.
     */
    public function line(): int;
}
