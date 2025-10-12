<?php

namespace Mpietrucha\Utility\Throwable\Synchronizer;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Throwable\Contracts\SynchronizerInterface;

abstract class None implements CreatableInterface, SynchronizerInterface
{
    use Arrayable, Creatable;

    final public function toArray(): array
    {
        return $this->property() |> Arr::wrap(...);
    }

    final public function build(FrameInterface $frame): array
    {
        $value = $this->value($frame);

        /** @var array{0: \Mpietrucha\Utility\Throwable\Property, 1: mixed} */
        return Arr::append($this->toArray(), $value);
    }

    final public function unexists(FrameInterface $frame): bool
    {
        return $this->exists($frame) |> Normalizer::not(...);
    }
}
