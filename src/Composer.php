<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Composer\Adapter;
use Mpietrucha\Utility\Composer\Autoload;
use Mpietrucha\Utility\Composer\Concerns\InteractsWithAdapter;
use Mpietrucha\Utility\Composer\Contracts\AutoloadInterface;
use Mpietrucha\Utility\Composer\Contracts\ComposerInterface;
use Mpietrucha\Utility\Concerns\Wrappable;
use Mpietrucha\Utility\Stream\Contracts\AdapterInterface;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

/**
 * @mixin \Mpietrucha\Utility\Composer\Contracts\AdapterInterface
 */
class Composer implements ComposerInterface
{
    use InteractsWithAdapter, Utilizable\String, Wrappable;

    protected AdapterInterface $adapter;

    protected ?AutoloadInterface $autoload = null;

    protected static ?ComposerInterface $default = null;

    protected static string $wrappable = ComposerInterface::class;

    public function __construct(null|AdapterInterface|string $adapter)
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

    protected static function hydrate(): ?string
    {
        return Filesystem::cwd();
    }
}
