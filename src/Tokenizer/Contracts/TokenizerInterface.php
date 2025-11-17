<?php

namespace Mpietrucha\Utility\Tokenizer\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface TokenizerInterface
{
    /**
     * Get the path interface for the tokenizer.
     */
    public function path(): PathInterface;

    /**
     * Get all tokens from the tokenizer.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Tokenizer\Contracts\TokenInterface>
     */
    public function get(): EnumerableInterface;
}
