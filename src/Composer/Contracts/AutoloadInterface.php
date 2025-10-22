<?php

namespace Mpietrucha\Utility\Composer\Contracts;

use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

interface AutoloadInterface extends InteractsWithAutoloaderInterface, InteractsWithComposerInterface, InteractsWithLoaderInterface, LoaderInterface, UtilizableInterface
{
    public static function load(ComposerInterface|string $composer): static;

    public static function default(null|ComposerInterface|string $composer = null): static;

    public function namespace(string $file, bool $canonicalized = false): ?string;
}
