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

    public function toString(): string
    {
        return parent::__toString();
    }

    public function id(): int
    {
        return $this->id;
    }

    public function text(): string
    {
        return $this->text;
    }

    public function line(): int
    {
        return $this->line;
    }

    public function position(): int
    {
        return $this->pos;
    }

    public function name(): ?string
    {
        return $this->getTokenName();
    }

    public function ignored(): bool
    {
        return $this->isIgnorable();
    }
}
