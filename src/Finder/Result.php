<?php

namespace Mpietrucha\Utility\Finder;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Finder\Contracts\ResultInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use Symfony\Component\Finder\SplFileInfo;

class Result implements CreatableInterface, ResultInterface
{
    use Creatable, Forwardable, Stringable;

    public function __construct(protected SplFileInfo $file)
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

    public static function build(string $file, string $path, string $name): static
    {
        return new SplFileInfo($file, $path, $name) |> static::create(...);
    }

    public function toArray(): array
    {
        return [
            $this->get(),
            $this->file()->getRelativePath(),
            $this->file()->getRelativePathname(),
        ];
    }

    public function toString(): string
    {
        return (string) $this->file();
    }

    public function file(): SplFileInfo
    {
        return $this->file;
    }

    public function get(): string
    {
        return $this->toString();
    }
}
