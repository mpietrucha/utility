<?php

namespace Mpietrucha\Utility\Fork\Concerns;

use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Normalizer;

/**
 * @internal
 */
trait InteractsWithContent
{
    use Stringable;

    public function toString(): string
    {
        return $this->content |> Normalizer::string(...);
    }

    public function set(string $content): static
    {
        $this->content = $content;

        return $this;
    }
}
