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

    /**
     * Create a line segment for the specified line number.
     */
    public function line(int $line): SegmentInterface
    {
        return Line::create($this, $line);
    }

    /**
     * Create a segment for the given content portion.
     */
    public function segment(mixed $segment): SegmentInterface
    {
        return Segment::build($this, $segment);
    }

    /**
     * Clear the specified content from the input.
     */
    public function clear(string $content): static
    {
        return $this->toStringable()->remove($content) |> $this->set(...);
    }

    /**
     * Replace search string with replacement content.
     */
    public function replace(string $search, string $content): static
    {
        return $this->toStringable()->replace($search, $content) |> $this->set(...);
    }
}
