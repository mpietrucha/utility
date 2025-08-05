<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\StringableInterface;
use Symfony\Component\Finder\SplFileInfo;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<string, string>
 */
interface ResultInterface extends ArrayableInterface, StringableInterface
{
    public static function build(string $file, string $path, string $name): ResultInterface;

    public function file(): SplFileInfo;

    public function get(): string;
}
