<?php

namespace Mpietrucha\Utility\Composer\Contracts;

use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

interface AutoloadInterface extends InteractsWithAutoloaderInterface, InteractsWithComposerInterface, InteractsWithMapInterface, MapInterface, UtilizableInterface
{
    /**
     * Load the autoloader for the given composer instance or path.
     */
    public static function load(ComposerInterface|string $composer): static;

    /**
     * Get the default autoloader instance.
     */
    public static function default(null|ComposerInterface|string $composer = null): static;

    /**
     * Get the namespace for the given file.
     */
    public function namespace(string $file, bool $canonicalized = false): ?string;
}
