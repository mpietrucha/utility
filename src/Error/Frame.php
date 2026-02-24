<?php

namespace Mpietrucha\Utility\Error;

use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Error\Contracts\FrameInterface;
use Mpietrucha\Utility\Error\Enums\Property;

/**
 * @phpstan-import-type RawErrorFrame from \Mpietrucha\Utility\Error\Contracts\FrameInterface
 */
class Frame implements CreatableInterface, FrameInterface
{
    use Arrayable, Creatable;

    /**
     * Create a new error frame instance.
     *
     * @param  RawErrorFrame  $error
     */
    public function __construct(protected array $error)
    {
    }

    /**
     * Convert the error frame to an array.
     */
    public function toArray(): array
    {
        return $this->error;
    }

    /**
     * Get the error type from the frame.
     */
    public function type(): int
    {
        return Property::Type |> $this->get(...);
    }

    /**
     * Get the error level from the frame.
     */
    public function level(): int
    {
        return $this->type();
    }

    /**
     * Get the error message from the frame.
     */
    public function message(): string
    {
        return Property::Message |> $this->get(...);
    }

    /**
     * Get the file path from the frame.
     */
    public function file(): string
    {
        return Property::File |> $this->get(...);
    }

    /**
     * Get the line number from the frame.
     */
    public function line(): int
    {
        return Property::Line |> $this->get(...);
    }

    /**
     * Get a property value from the error frame.
     */
    protected function get(Property $property): mixed
    {
        return $this->toArray() |> $property->lookup(...);
    }
}
