<?php

namespace Mpietrucha\Utility\Throwable\Concerns;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Backtrace;
use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Wrappable;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Reflection as Adapter;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Throwable\Enums\Property;
use Mpietrucha\Utility\Throwable\Synchronizer;
use Mpietrucha\Utility\Type;
use Throwable;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Throwable\Contracts\ReflectionInterface
 *
 * @phpstan-import-type BacktraceFrameCollection from \Mpietrucha\Utility\Backtrace
 */
trait InteractsWithReflection
{
    use Wrappable;

    /**
     * @var \Mpietrucha\Utility\Reflection<object>|null
     */
    protected ?Adapter $adapter = null;

    /**
     * @var BacktraceFrameCollection|null
     */
    protected ?EnumerableInterface $backtrace = null;

    /**
     * Create a new reflection wrapper for the given throwable.
     */
    public function __construct(protected Throwable $throwable)
    {
    }

    /**
     * Populate the reflected file and line from the given stack frame.
     */
    public function synchronize(FrameInterface $frame): static
    {
        $this->set(...) |> Synchronizer::groups($frame)->eachSpread(...);

        return $this;
    }

    /**
     * Override the throwable's error code.
     */
    public function code(int $code): static
    {
        return $this->set(Property::CODE, $code);
    }

    /**
     * Override the throwable's source line number.
     */
    public function line(int $line): static
    {
        return $this->set(Property::LINE, $line);
    }

    /**
     * Override the throwable's source file path.
     */
    public function file(string $file): static
    {
        return $this->set(Property::FILE, $file);
    }

    /**
     * Replace the throwable's stack trace with the given trace array.
     */
    public function trace(iterable $backtrace): static
    {
        $backtrace = Normalizer::array($backtrace) |> Arr::values(...);

        return $this->reset(Property::TRACE, $backtrace);
    }

    /**
     * Format and set a new exception message.
     */
    public function message(string $message, mixed ...$arguments): static
    {
        $message = Str::sprintf($message, ...$arguments);

        return $this->set(Property::MESSAGE, $message);
    }

    /**
     * Set the previous throwable in the exception chain.
     */
    public function previous(?Throwable $previous): static
    {
        return $this->set(Property::PREVIOUS, $previous);
    }

    /**
     * Skip the specified number of frames from the backtrace.
     */
    public function skip(int $frames = 1): static
    {
        return $this->backtrace()->skip($frames) |> $this->trace(...);
    }

    /**
     * Align the throwable's file and line to the frame at the given index.
     */
    public function align(int $index = 0): static
    {
        if ($index < 0) {
            return $this;
        }

        $frame = $this->backtrace()->get($index);

        if (Type::null($frame)) {
            return $this->align(--$index);
        }

        return $this->skip(++$index)->synchronize($frame);
    }

    /**
     * Get the underlying throwable instance.
     */
    public function value(): Throwable
    {
        return $this->throwable;
    }

    /**
     * Lazily build and return the throwable's backtrace frames.
     *
     * @return BacktraceFrameCollection
     */
    public function backtrace(): EnumerableInterface
    {
        return $this->backtrace ??= Backtrace::throwable($this);
    }

    /**
     * Write a raw property value directly onto the underlying throwable.
     */
    protected function set(Property $property, mixed $value): static
    {
        $property = $property->value() |> $this->adapter()->getProperty(...);

        $property->setValue($this->value(), $value);

        return $this;
    }

    /**
     * Reset the backtrace cache and set a property value.
     */
    protected function reset(Property $property, mixed $value): static
    {
        $this->backtrace = null;

        return $this->set($property, $value);
    }

    /**
     * Get a cached reflection adapter for the underlying throwable class.
     *
     * @return \Mpietrucha\Utility\Reflection<object>
     */
    protected function adapter(): Adapter
    {
        return $this->adapter ??= $this->value() |> Adapter::deep(...);
    }
}
