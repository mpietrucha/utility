<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Tokenizer\Contracts\PathInterface;
use Mpietrucha\Utility\Tokenizer\Contracts\TokenizerInterface;
use Mpietrucha\Utility\Tokenizer\Path;
use Mpietrucha\Utility\Tokenizer\Token;

class Tokenizer implements CreatableInterface, TokenizerInterface
{
    use Creatable;

    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Tokenizer\Contracts\TokenInterface>|null
     */
    protected ?EnumerableInterface $tokens = null;

    public function __construct(protected string $code)
    {
    }

    public function path(): PathInterface
    {
        return Path::create($this);
    }

    public function get(): EnumerableInterface
    {
        return $this->tokens ??= $this->code() |> Token::tokenize(...) |> Collection::create(...);
    }

    protected function code(): string
    {
        return $this->code;
    }
}
