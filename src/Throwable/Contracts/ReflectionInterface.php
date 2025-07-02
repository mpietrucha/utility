<?php

namespace Mpietrucha\Utility\Throwable\Contracts;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Throwable;

interface ReflectionInterface extends CreatableInterface, InteractsWithThrowableInterface
{
    /**
     * Configure the throwable's metadata, including trace and frame.
     */
    public function configure(): static;

    /**
     * Apply file and line information from the given frame.
     */
    public function frame(FrameInterface $frame): static;

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
     */
    public function trace(mixed $backtrace): static;

    /**
     * Set a custom error message on the throwable.
     */
    public function message(mixed $message): static;

    /**
     * Set the previous throwable in the exception chain.
     */
    public function previous(?Throwable $previous): static;

    /**
     * Get the parsed backtrace frames associated with the throwable.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Frame>
     */
    public function backtrace(): EnumerableInterface;
}
