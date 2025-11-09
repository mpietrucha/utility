<?php

namespace Mpietrucha\Utility\Tokenizer\Path;

use Mpietrucha\Utility\Tokenizer\Token;

abstract class Name
{
    /**
     * Get the token ID for a qualified namespace.
     */
    public static function get(): int
    {
        return Token::NAMESPACE_QUALIFIED;
    }

    /**
     * Get the token ID for a fully qualified namespace.
     */
    public static function canonicalized(): int
    {
        return Token::NAMESPACE_FULLY_QUALIFIED;
    }

    /**
     * Get the token ID for the next string token.
     */
    public static function next(): int
    {
        return Token::STRING;
    }

    /**
     * Get the token IDs that can precede a class name.
     *
     * @return list<int>
     */
    public static function previous(): array
    {
        return [Token::CLASS_NAME, Token::TRAIT_NAME, Token::INTERFACE_NAME];
    }
}
