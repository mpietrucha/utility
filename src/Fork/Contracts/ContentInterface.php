<?php

namespace Mpietrucha\Utility\Fork\Contracts;

use Mpietrucha\Utility\Contracts\StringableInterface;

interface ContentInterface extends InteractsWithSegmentInterface, StringableInterface
{
    public function clear(string $content): static;

    public function set(string $content): static;

    public function replace(string $search, string $content): static;
}
