<?php

namespace Mpietrucha\Utility\Fork\Contracts;

interface ContentInterface
{
    public function get(): string;

    public function line(int $line): LineInterface;

    public function set(string $content): void;

    public function clear(string $line): void;

    public function change(string $from, string $to): void;
}
