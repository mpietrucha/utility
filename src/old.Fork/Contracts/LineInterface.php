<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface LineInterface
{
    public function get(): ?string;

    public function clear(): void;

    public function change(string $to): void;
}
