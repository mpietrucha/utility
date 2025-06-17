<?php

namespace Mpietrucha\Utility\Backtrace;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Pipeable;
use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\PipeableInterface;
use Mpietrucha\Utility\Illuminate\Arr;
use Mpietrucha\Utility\Illuminate\LazyCollection;

class Frame implements ArrayableInterface, CreatableInterface, PipeableInterface
{
    use Creatable, Pipeable;

    protected function __construct(protected array $frame)
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

    public function arguments(): LazyCollection
    {
        return LazyCollection::create(fn () => $this->get(Property::ARGUMENTS));
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
