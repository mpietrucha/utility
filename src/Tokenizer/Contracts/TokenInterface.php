<?php

namespace Mpietrucha\Utility\Tokenizer\Contracts;

use Mpietrucha\Utility\Contracts\StringableInterface;

interface TokenInterface extends InteractsWithTokens, StringableInterface
{
    /**
     * Get the token identifier.
     */
    public function id(): int;

    /**
     * Get the token text content.
     */
    public function text(): string;

    /**
     * Get the line number of the token.
     */
    public function line(): int;

    /**
     * Get the position of the token.
     */
    public function position(): int;

    /**
     * Get the token name.
     */
    public function name(): ?string;

    /**
     * Determine if the token should be ignored.
     */
    public function ignored(): bool;

    /**
     * Determine if the token matches the given kind.
     *
     * @param  int|string|list<int|string>  $kind
     */
    public function is(array|int|string $kind): bool;
}
