<?php

namespace Mpietrucha\Utility\Tokenizer\Path;

use Mpietrucha\Utility\Tokenizer\Token;

abstract class Name
{
    public static function get(): int
    {
        return Token::NAMESPACE_QUALIFIED;
    }

    public static function canonicalized(): int
    {
        return Token::NAMESPACE_FULLY_QUALIFIED;
    }

    public static function next(): int
    {
        return Token::STRING;
    }

    /**
     * @return list<int>
     */
    public static function previous(): array
    {
        return [Token::CLASS_NAME, Token::TRAIT_NAME, Token::INTERFACE_NAME];
    }
}
