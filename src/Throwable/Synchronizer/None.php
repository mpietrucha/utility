<?php

namespace Mpietrucha\Utility\Throwable\Synchronizer;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Throwable\Contracts\SynchronizerInterface;

abstract class None implements CreatableInterface, SynchronizerInterface
{
    use Creatable;

    final public function build(FrameInterface $frame): array
    {
        return [$this->property(), $this->value($frame)];
    }

    final public function unexists(FrameInterface $frame): bool
    {
        return $this->exists($frame) |> Normalizer::not(...);
    }
}
