<?php

namespace Mpietrucha\Utility\Finder;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Finder\Contracts\FileInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use Mpietrucha\Utility\Illuminate\Arr;
use Symfony\Component\Finder\SplFileInfo;

/**
 * @mixin \Mpietrucha\Utility\Filesystem
 */
class File implements CreatableInterface, FileInterface
{
    use Creatable, Forwardable, Stringable;

    public function __construct(protected SplFileInfo $adapter)
    {
    }

    /**
     * @param  array<int|string, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        $arguments = Arr::prepend($arguments, $this->get());

        return $this->forward(Filesystem::class)->eval($method, $arguments);
    }

    public function adapter(): SplFileInfo
    {
        return $this->adapter;
    }

    public function toString(): string
    {
        return (string) $this->adapter();
    }

    public function get(): string
    {
        return $this->toString();
    }
}
