<?php

namespace Mpietrucha\Utility\Backtrace;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Pipeable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Frame implements CreatableInterface, FrameInterface
{
    use Arrayable, Creatable, Pipeable;

    /**
     * Create a new Frame instance from a raw backtrace frame array.
     *
     * @param  RawBacktraceFrame  $frame
     */
    public function __construct(protected array $frame)
    {
    }

    /**
     * Get the raw backtrace frame as an array.
     *
     * @return RawBacktraceFrame
     */
    public function toArray(): array
    {
        return $this->frame;
    }

    /**
     * Get the file path from the backtrace frame.
     */
    public function file(): ?string
    {
        return Property::FILE |> $this->get(...);
    }

    /**
     * Get the line number from the backtrace frame.
     */
    public function line(): ?int
    {
        return Property::LINE |> $this->get(...);
    }

    /**
     * Get the call type (e.g., '->' or '::') from the backtrace frame.
     */
    public function type(): ?string
    {
        return Property::TYPE |> $this->get(...);
    }

    /**
     * Get the arguments passed to the function or method in the backtrace frame.
     *
     * @return \Mpietrucha\Utility\Collection<string, mixed>
     */
    public function arguments(): Collection
    {
        return Property::ARGUMENTS |> $this->get(...) |> Collection::create(...);
    }

    /**
     * Get the namespace or class name from the backtrace frame.
     */
    public function namespace(): ?string
    {
        return Property::NAMESPACE |> $this->get(...);
    }

    /**
     * Get the object instance from the backtrace frame.
     */
    public function instance(): ?object
    {
        return Property::INSTANCE |> $this->get(...);
    }

    /**
     * Get the function or method name from the backtrace frame.
     */
    public function function(): string
    {
        return Property::FUNCTION |> $this->get(...);
    }

    /**
     * Retrieve the value of the given property from the backtrace frame array.
     */
    protected function get(Property $property): mixed
    {
        return $property->value |> $this->toCollection()->get(...);
    }
}
