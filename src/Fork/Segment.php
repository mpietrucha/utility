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

    public function __construct(protected ContentInterface $content, ?string $input = null)
    {
        Normalizer::string($input) |> $this->input(...);
    }

    public static function build(ContentInterface $content, mixed $input): static
    {
        $input = $content->toStringable(...) |> Value::for($input)->string(...);

        return static::create($content, $input);
    }

    public function clear(): void
    {
        $this->toString() |> $this->content()->clear(...);
    }

    public function set(string $content): void
    {
        $this->content()->replace($this->toString(), $content);
    }

    public function replace(string $search, string $content): void
    {
        $this->toStringable()->replace($search, $content) |> $this->set(...);
    }

    protected function content(): ContentInterface
    {
        return $this->content;
    }
}
