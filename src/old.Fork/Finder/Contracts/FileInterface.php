<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Contracts\StringableInterface;
use Symfony\Component\Finder\SplFileInfo;

interface FileInterface extends StringableInterface
{
    public static function build(string $file, string $relative, string $name): FileInterface;

    public function adapter(): SplFileInfo;

    public function get(): string;
}
