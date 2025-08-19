<?php

namespace Mpietrucha\Utility\Fork\Contracts;

use Mpietrucha\Utility\Contracts\StringableInterface;

interface BodyInterface extends InteractsWithSectionInterface, StringableInterface
{
    public function clear(string $content): BodyInterface;

    public function set(string $content): BodyInterface;

    public function replace(string $search, string $content): BodyInterface;
}
