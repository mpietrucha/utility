<?php

namespace Mpietrucha\Utility\Backtrace;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Pipeable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Illuminate\Arr;
use Mpietrucha\Utility\Illuminate\Collection;

class Frame implements CreatableInterface, FrameInterface
{
    use Creatable, Pipeable;

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
        return $this->get(Property::FILE);
    }

    /**
     * Get the line number from the backtrace frame.
     */
    public function line(): ?int
    {
        return $this->get(Property::LINE);
    }

    /**
     * Get the call type (e.g., '->' or '::') from the backtrace frame.
     */
    public function type(): ?string
    {
        return $this->get(Property::TYPE);
    }

    /**
     * Get the arguments passed to the function or method in the backtrace frame.
     *
     * @return \Mpietrucha\Utility\Illuminate\Collection<string, mixed>
     */
    public function arguments(): Collection
    {
        $arguments = $this->get(Property::ARGUMENTS);

        return Collection::create($arguments);
    }

    /**
     * Get the namespace or class name from the backtrace frame.
     */
    public function namespace(): ?string
    {
        return $this->get(Property::NAMESPACE);
    }

    /**
     * Get the object instance from the backtrace frame.
     */
    public function instance(): ?object
    {
        return $this->get(Property::INSTANCE);
    }

    /**
     * Get the function or method name from the backtrace frame.
     */
    public function function(): string
    {
        return $this->get(Property::FUNCTION);
    }

    /**
     * Retrieve the value of the given property from the backtrace frame array.
     */
    protected function get(Property $property): mixed
    {
        return Arr::get($this->toArray(), $property->value);
    }
}
