<?php

namespace Mpietrucha\Utility\Filesystem\Contracts;

interface InteractsWithOutputInterface
{
    public static function use(string $output): void;

    public static function output(): string;
}
