<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Concerns\InteractsWithInput;
use Mpietrucha\Utility\Fork\Contracts\ContentInterface;
use Mpietrucha\Utility\Fork\Contracts\SegmentInterface;

class Content implements ContentInterface, CreatableInterface
{
    use Creatable, InteractsWithInput;

    public function line(int $line): SegmentInterface
    {
        return Line::create($this, $line);
    }

    public function segment(mixed $segment): SegmentInterface
    {
        return Segment::build($this, $segment);
    }

    public function clear(string $content): static
    {
        return $this->toStringable()->remove($content) |> $this->set(...);
    }

    public function replace(string $search, string $content): static
    {
        return $this->toStringable()->replace($search, $content) |> $this->set(...);
    }
}
