<?php

namespace Mpietrucha\Utility\Fork\Contracts;

use Mpietrucha\Utility\Contracts\StringableInterface;

interface SegmentInterface extends StringableInterface
{
    public function clear(): void;

    public function set(string $content): void;

    public function replace(string $search, string $content): void;
}
