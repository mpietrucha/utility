<?php

namespace Mpietrucha\Utility\Fork\Concerns;

use Mpietrucha\Utility\Concerns\Stringable;

/**
 * @internal
 */
trait InteractsWithContent
{
    use Stringable;

    public function toString(): string
    {
        return $this->content;
    }

    public function set(string $content): static
    {
        $this->content = $content;

        return $this;
    }
}
