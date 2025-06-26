<?php

namespace Mpietrucha\Utility\Backtrace\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\PipeableInterface;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<string, RawBacktraceFrame>
 */
interface FrameInterface extends ArrayableInterface, PipeableInterface
{
    /**
     * Get the file path associated with the backtrace frame.
     */
    public function file(): ?string;

    /**
     * Get the line number associated with the backtrace frame.
     */
    public function line(): ?int;

    /**
     * Get the call type (e.g., '->' or '::') for the backtrace frame.
     */
    public function type(): ?string;

    /**
     * Get the arguments passed to the function or method in the backtrace frame.
     *
     * @return \Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface<string, mixed>
     */
    public function arguments(): EnumerableInterface;

    /**
     * Get the namespace or class name associated with the backtrace frame.
     */
    public function namespace(): ?string;

    /**
     * Get the object instance associated with the backtrace frame.
     */
    public function instance(): ?object;

    /**
     * Get the function or method name associated with the backtrace frame.
     */
    public function function(): string;
}
