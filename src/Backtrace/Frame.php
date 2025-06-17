<?php

namespace Mpietrucha\Utility\Backtrace;

use Mpietrucha\Utility\Backtrace\Contracts\FrameInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Frame implements CreatableInterface, FrameInterface
{
    use Creatable;

    /**
        @param array<string, array<mixed>|int|object|string> $frame
     */
    public function __construct(protected array $frame)
    {
    }

    /**
        @return array<string, array<mixed>|int|object|string> $frame
     */
    public function toArray(): array
    {
        return $this->frame;
    }
}
