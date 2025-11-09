<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Concerns\InteractsWithInput;
use Mpietrucha\Utility\Fork\Contracts\ContentInterface;
use Mpietrucha\Utility\Fork\Contracts\SegmentInterface;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Value;

class Segment implements CreatableInterface, SegmentInterface
{
    use Creatable, InteractsWithInput;

    /**
     * Create a new segment for the given content with optional input string.
     */
    public function __construct(protected ContentInterface $content, ?string $input = null)
    {
        Normalizer::string($input) |> $this->input(...);
    }

    /**
     * Build a segment by evaluating the input value against the content.
     */
    public static function build(ContentInterface $content, mixed $input): static
    {
        $input = $content->toStringable(...) |> Value::for($input)->string(...);

        return static::create($content, $input);
    }

    /**
     * Clear this segment from the content.
     */
    public function clear(): void
    {
        $this->toString() |> $this->content()->clear(...);
    }

    /**
     * Set this segment to the given content.
     */
    public function set(string $content): void
    {
        $this->content()->replace($this->toString(), $content);
    }

    /**
     * Replace search string with replacement content within this segment.
     */
    public function replace(string $search, string $content): void
    {
        $this->toStringable()->replace($search, $content) |> $this->set(...);
    }

    /**
     * Get the parent content instance.
     */
    protected function content(): ContentInterface
    {
        return $this->content;
    }
}
