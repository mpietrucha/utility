<?php

namespace Mpietrucha\Utility\Tokenizer\Contracts;

interface PathInterface
{
    /**
     * Create a path instance for the given code.
     */
    public static function for(string $code): static;

    /**
     * Get the namespace token.
     */
    public function namespace(): ?TokenInterface;

    /**
     * Get the name token.
     */
    public function name(): ?TokenInterface;

    /**
     * Get the canonicalized token.
     */
    public function canonicalize(): ?TokenInterface;

    /**
     * Get the token with optional canonicalization.
     */
    public function get(bool $canonicalized = false): ?TokenInterface;
}
