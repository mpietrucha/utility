<?php

namespace Mpietrucha\Utility\Backtrace;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Pipeable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\PipeableInterface;
use Mpietrucha\Utility\Illuminate\Arr;
use Mpietrucha\Utility\Illuminate\Collection;

class Frame implements CreatableInterface, FrameInterface, PipeableInterface
{
    use Creatable, Pipeable;

    public function __construct(protected array $frame)
    {
    }

    public function toArray(): array
    {
        return $this->frame;
    }

    public function file(): string
    {
        return $this->get(Property::FILE);
    }

    public function line(): int
    {
        return $this->get(Property::LINE);
    }

    public function type(): string
    {
        return $this->get(Property::TYPE);
    }

    public function arguments(): Collection
    {
        $arguments = $this->get(Property::ARGUMENTS);

        return Collection::create($arguments);
    }

    public function namespace(): string
    {
        return $this->get(Property::NAMESPACE);
    }

    public function instance(): ?object
    {
        return $this->get(Property::INSTANCE);
    }

    public function function(): string
    {
        return $this->get(Property::FUNCTION);
    }

    protected function get(Property $property): mixed
    {
        return Arr::get($this->toArray(), $property->value);
    }
}
