<?php

namespace Mpietrucha\Utility\Backtrace\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\PipeableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @phpstan-type RawBacktraceFrame array{function: string, line?: int, file?: string, class?: class-string, type?: '->'|'::', args?: array<string, mixed>, object?: object}
 *
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<string, mixed>
 */
interface FrameInterface extends ArrayableInterface, PipeableInterface
{
    /**
     * Get the raw backtrace frame as an array.
     *
     * @return RawBacktraceFrame
     */
    public function toArray(): array;

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
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, mixed>
     */
    public function arguments(): EnumerableInterface;

    /**
     * Get the namespace or class name associated with the backtrace frame.
     */
    public function namespace(): ?string;

    /**
     * Determine if the frame is internal to the given value.
     *
     * @php-assert-if-true class-string $this->namespace()
     */
    public function internal(object|string $value): bool;

    /**
     * Determine if the frame is external to the given value.
     *
     * @phpstan-assert-if-false class-string $this->namespace()
     */
    public function external(object|string $value): bool;

    /**
     * Get the object instance associated with the backtrace frame.
     */
    public function instance(): ?object;

    /**
     * Get the function or method name associated with the backtrace frame.
     */
    public function function(): string;
}
