<?php

namespace Mpietrucha\Utility\Error;

use Mpietrucha\Utility\Arr;
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
     * @param  RawErrorFrame  $error
     */
    public function __construct(protected array $error)
    {
    }

    public function toArray(): array
    {
        return $this->error;
    }

    public function type(): int
    {
        return Property::TYPE |> $this->get(...);
    }

    public function message(): string
    {
        return Property::MESSAGE |> $this->get(...);
    }

    public function file(): string
    {
        return Property::FILE |> $this->get(...);
    }

    public function line(): int
    {
        return Property::LINE |> $this->get(...);
    }

    protected function get(Property $property): mixed
    {
        $input = $this->toArray();

        return Arr::get($input, $property->value);
    }
}
