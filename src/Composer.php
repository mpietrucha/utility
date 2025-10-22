<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Composer\Adapter;
use Mpietrucha\Utility\Composer\Autoload;
use Mpietrucha\Utility\Composer\Concerns\InteractsWithAdapter;
use Mpietrucha\Utility\Composer\Contracts\AdapterInterface;
use Mpietrucha\Utility\Composer\Contracts\AutoloadInterface;
use Mpietrucha\Utility\Composer\Contracts\ComposerInterface;
use Mpietrucha\Utility\Concerns\Wrappable;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

/**
 * @mixin \Mpietrucha\Utility\Composer\Contracts\AdapterInterface
 */
class Composer implements ComposerInterface
{
    use InteractsWithAdapter, Utilizable\Cwd, Wrappable;

    protected AdapterInterface $adapter;

    protected ?AutoloadInterface $autoload = null;

    protected static ?ComposerInterface $default = null;

    /**
     * @var class-string
     */
    protected static string $wrappable = ComposerInterface::class;

    public function __construct(AdapterInterface|string $adapter)
    {
        $this->adapter = Adapter::wrap($adapter);
    }

    public static function default(): ComposerInterface
    {
        return static::utilize() |> static::create(...);
    }

    public static function get(): ComposerInterface
    {
        return static::$default ??= static::default();
    }

    public function adapter(): AdapterInterface
    {
        return $this->adapter;
    }

    public function autoload(): AutoloadInterface
    {
        return $this->autoload ??= Autoload::default($this);
    }
}
