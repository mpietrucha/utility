<?php

namespace Mpietrucha\Utility\Tokenizer\Contracts;

use Mpietrucha\Utility\Contracts\StringableInterface;

interface TokenInterface extends InteractsWithTokens, StringableInterface
{
    public function id(): int;

    public function text(): string;

    public function line(): int;

    public function position(): int;

    public function name(): ?string;

    public function ignored(): bool;

    /**
     * @param  int|string|list<int|string>  $kind
     */
    public function is(array|int|string $kind): bool;
}
