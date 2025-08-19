<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Concerns\InteractsWithContent;
use Mpietrucha\Utility\Fork\Contracts\BodyInterface;
use Mpietrucha\Utility\Fork\Contracts\SectionInterface;

class Section implements CreatableInterface, SectionInterface
{
    use Creatable, InteractsWithContent;

    public function __construct(protected BodyInterface $body, protected ?string $content = null)
    {
    }

    public static function build(BodyInterface $body, mixed $content): static
    {
        $content = $body->toStringable() |> Value::for($content)->string(...);

        return static::create($body, $content);
    }

    public function clear(): void
    {
        $this->toString() |> $this->body()->clear(...);
    }

    public function set(string $content): void
    {
        $this->body()->replace($this->toString(), $content);
    }

    public function replace(string $search, string $content): void
    {
        $this->toStringable()->replace($search, $content) |> $this->set(...);
    }

    protected function body(): BodyInterface
    {
        return $this->body;
    }
}
