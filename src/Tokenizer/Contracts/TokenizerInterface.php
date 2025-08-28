<?php

namespace Mpietrucha\Utility\Tokenizer\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

interface TokenizerInterface
{
    public function path(): PathInterface;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, \Mpietrucha\Utility\Tokenizer\Contracts\TokenInterface>
     */
    public function get(): EnumerableInterface;
}
