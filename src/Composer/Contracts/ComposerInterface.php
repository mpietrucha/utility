<?php

namespace Mpietrucha\Utility\Composer\Contracts;

use Mpietrucha\Utility\Contracts\WrappableInterface;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

interface ComposerInterface extends AdapterInterface, InteractsWithAdapterInterface, InteractsWithAutoloadInterface, UtilizableInterface, WrappableInterface
{
    /**
     * Get the default composer instance.
     */
    public static function default(): ComposerInterface;

    /**
     * Get the composer instance.
     */
    public static function get(): ComposerInterface;
}
