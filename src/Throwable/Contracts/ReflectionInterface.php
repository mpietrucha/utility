<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Contracts\WrappableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Throwable;

/**
 * @phpstan-import-type RawBacktraceFrame from \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface
 */
interface ReflectionInterface extends WrappableInterface
{
    /**
     * Apply file and line information from the given frame.
     */
    public function synchronize(FrameInterface $frame): static;

    /**
     * Set a custom error code on the throwable.
     */
    public function code(int $code): static;

    /**
     * Set a custom source line number on the throwable.
     */
    public function line(int $line): static;

    /**
     * Set a custom source file path on the throwable.
     */
    public function file(string $file): static;

    /**
     * Replace the throwable's stack trace.
     *
     * @param  iterable<int, RawBacktraceFrame>  $backtrace
     */
    public function trace(iterable $backtrace): static;

    /**
     * Set a custom error message on the throwable.
     */
    public function message(string $message): static;

    /**
     * Set the previous throwable in the exception chain.
     */
    public function previous(?Throwable $previous): static;

    /**
     * Skip the throwable's stack trace frames.
     */
    public function skip(int $frames = 1): static;

    /**
     * Skip the throwable's stack trace frames and align to first frame.
     */
    public function align(int $index = 0): static;

    /**
     * Get the underlying throwable instance.
     */
    public function value(): Throwable;

    /**
     * Get the parsed backtrace frames associated with the throwable.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>
     */
    public function backtrace(): EnumerableInterface;
}
