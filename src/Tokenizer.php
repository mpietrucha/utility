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

    /**
     * Create a new tokenizer instance for the given code.
     */
    public function __construct(protected string $code)
    {
    }

    /**
     * Get a path resolver for navigating the token tree.
     */
    public function path(): PathInterface
    {
        return Path::create($this);
    }

    /**
     * Get the collection of tokens parsed from the code.
     */
    public function get(): EnumerableInterface
    {
        return $this->tokens ??= $this->code() |> Token::tokenize(...) |> Collection::create(...);
    }

    /**
     * Get the raw code string being tokenized.
     */
    protected function code(): string
    {
        return $this->code;
    }
}
