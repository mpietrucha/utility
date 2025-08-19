<?php

namespace Mpietrucha\Utility\Throwable;

use Mpietrucha\Utility\Backtrace;
use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Backtrace\Property as Frame;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Pipeable;
use Mpietrucha\Utility\Concerns\Tappable;
use Mpietrucha\Utility\Contracts\PipeableInterface;
use Mpietrucha\Utility\Contracts\TappableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Reflection as Adapter;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Throwable\Contracts\ReflectionInterface;
use Mpietrucha\Utility\Type;
use Throwable;

class Reflection implements PipeableInterface, ReflectionInterface, TappableInterface
{
    use Creatable, Pipeable, Tappable;

    /**
     * @var \Mpietrucha\Utility\Reflection<object>|null
     */
    protected ?Adapter $adapter = null;

    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>|null
     */
    protected ?EnumerableInterface $backtrace = null;

    /**
     * Create a new throwable reflection wrapper and bootstrap its metadata.
     */
    protected function __construct(protected Throwable $throwable)
    {
        $this->configure()->bootstrap();
    }

    /**
     * Trim the backtrace to the desired range and sync the first frame and trace.
     */
    public function configure(int $end = 1, int $start = 1): static
    {
        $backtrace = $this->backtrace()->skip($start);

        $frame = $backtrace->first();

        Type::object($frame) && $this->frame($frame);

        $backtrace->skip($end) |> $this->trace(...);

        return $this;
    }

    /**
     * Populate the reflected file and line from the given stack frame.
     */
    public function frame(FrameInterface $frame): static
    {
        [$file, $line] = [$frame->file(), $frame->line()];

        Type::string($file) && $this->file($file);

        Type::integer($line) && $this->line($line);

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
    public function trace(mixed $trace): static
    {
        $trace = Normalizer::array($trace);

        return $this->set(Property::TRACE, $trace);
    }

    /**
     * Format and set a new exception message.
     */
    public function message(mixed $message, mixed ...$arguments): static
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
     * Get the underlying throwable instance.
     */
    public function value(): Throwable
    {
        return $this->throwable;
    }

    /**
     * Lazily build and return the throwable's backtrace frames.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Backtrace\Contracts\FrameInterface>
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
        $property = $property->value |> $this->adapter()->getProperty(...);

        $property->setValue($this->value(), $value);

        return $this;
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

    /**
     * Perform additional setup steps; intended for overriding in subclasses.
     */
    protected function bootstrap(): void
    {
    }
}
