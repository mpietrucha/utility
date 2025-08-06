<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Fork\Contracts\StorageInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Instance;

class Storage implements CreatableInterface, StorageInterface
{
    use Creatable;

    public function __construct(protected ?string $directory = null)
    {
    }

    public function flush(): void
    {
        $this->directory() |> Filesystem::cleanDirectory(...);
    }

    public function validate(): void
    {
    }

    public function identify(TransformerInterface $transformer): string
    {
        $file = $transformer->file();

        return Filesystem::hash($file) . Instance::hash($transformer) |> Hash::md5(...);
    }

    public function store(TransformerInterface $transformer): string
    {
        $file = $this->identify($transformer) |> $this->file(...);

        Filesystem::not()->file($file) && Filesystem::put($file, $this->transform($transformer));

        return $file;
    }

    public function transform(TransformerInterface $transformer): string
    {
        $source = $transformer->file() |> Filesystem::get(...) |> $transformer::source(...);

        return $transformer->transform($source) |> $source->get(...);
    }

    public function file(string $identity): string
    {
        return Filesystem\Path::absolute($identity, $this->directory());
    }

    protected function directory(): string
    {
        return $this->directory ??= Filesystem\Path::cache();
    }
}
