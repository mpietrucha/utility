<?php

namespace Mpietrucha\Utility\Tokenizer\Contracts;

interface PathInterface
{
    public static function for(string $code): static;

    public function namespace(): ?TokenInterface;

    public function name(): ?TokenInterface;

    public function canonicalize(): ?TokenInterface;

    public function get(bool $canonicalized = false): ?TokenInterface;
}
