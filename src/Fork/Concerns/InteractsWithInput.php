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

    /**
     * Create a new instance with the given input string.
     */
    public function __construct(string $input)
    {
        $this->input($input);
    }

    /**
     * Convert the input to a string.
     */
    public function toString(): string
    {
        return $this->input;
    }

    /**
     * Set the input string.
     */
    public function set(string $input): static
    {
        $this->input($input);

        return $this;
    }

    /**
     * Store the input string internally.
     */
    protected function input(string $input): void
    {
        $this->input = $input;
    }
}
