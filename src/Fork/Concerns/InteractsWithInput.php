<?php

namespace Mpietrucha\Utility\Fork\Concerns;

use Mpietrucha\Utility\Concerns\Stringable;

/**
 * @internal
 */
trait InteractsWithInput
{
    use Stringable;

    protected string $input;

    public function __construct(string $input)
    {
        $this->input($input);
    }

    public function toString(): string
    {
        return $this->input;
    }

    public function set(string $input): static
    {
        $this->input($input);

        return $this;
    }

    protected function input(string $input): void
    {
        $this->input = $input;
    }
}
