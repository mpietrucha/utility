<?php

namespace Mpietrucha\Utility\Tokenizer;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Tokenizer\Contracts\TokenInterface;
use PhpToken;

class Token extends PhpToken implements CreatableInterface, TokenInterface
{
    use Creatable, Stringable;

    /**
     * Convert the token to a string representation.
     */
    public function toString(): string
    {
        return parent::__toString();
    }

    /**
     * Get the token ID.
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * Get the token text content.
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     * Get the line number where the token appears.
     */
    public function line(): int
    {
        return $this->line;
    }

    /**
     * Get the position of the token in the source code.
     */
    public function position(): int
    {
        return $this->pos;
    }

    /**
     * Get the token name.
     */
    public function name(): ?string
    {
        return $this->getTokenName();
    }

    /**
     * Determine if the token is ignorable.
     */
    public function ignored(): bool
    {
        return $this->isIgnorable();
    }
}
