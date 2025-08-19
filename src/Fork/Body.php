<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Concerns\InteractsWithContent;
use Mpietrucha\Utility\Fork\Concerns\InteractsWithSection;
use Mpietrucha\Utility\Fork\Contracts\BodyInterface;

class Body implements BodyInterface, CreatableInterface
{
    use Creatable, InteractsWithContent, InteractsWithSection;

    public function __construct(protected string $content)
    {
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
