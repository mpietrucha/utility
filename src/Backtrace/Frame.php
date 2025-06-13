<?php

namespace Mpietrucha\Utility\Backtrace;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Frame implements CreatableInterface, FrameInterface
{
    use Creatable;

    public function __construct(protected array $frame)
    {
    }

    public function toArray(): array
    {
        return $this->frame;
    }
}
