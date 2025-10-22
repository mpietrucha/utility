<?php

namespace Mpietrucha\Utility\Composer\Contracts;

use Mpietrucha\Utility\Contracts\WrappableInterface;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

interface ComposerInterface extends AdapterInterface, InteractsWithAdapterInterface, InteractsWithAutoloadInterface, UtilizableInterface, WrappableInterface
{
    public static function default(): ComposerInterface;

    public static function get(): ComposerInterface;
}
