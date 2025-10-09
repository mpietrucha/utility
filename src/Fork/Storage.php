<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Concerns\InteractsWithOutput;
use Mpietrucha\Utility\Fork\Contracts\StorageInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Lottery;
use Mpietrucha\Utility\Lottery\Contracts\LotteryInterface;
use Mpietrucha\Utility\Normalizer;

class Storage implements CreatableInterface, StorageInterface
{
    use Creatable, InteractsWithOutput;

    public function __construct(protected ?string $directory = null, protected ?LotteryInterface $lottery = null)
    {
    }

    public function validate(): void
    {
        $this->flush(...) |> $this->lottery()->wins(...);
    }

    public function flush(): void
    {
        $this->directory() |> Filesystem\Temporary::flush(...);
    }

    public function identify(TransformerInterface $transformer): string
    {
        $file = $transformer->file();

        $transformer = Instance::file($transformer) |> Normalizer::string(...);

        return Filesystem::hash($file) . Filesystem::hash($transformer) |> Hash::md5(...);
    }

    public function store(TransformerInterface $transformer): string
    {
        $file = $this->identify($transformer) |> $this->file(...);

        Filesystem::not()->file($file) && Filesystem::put($file, $this->transform($transformer));

        return $file;
    }

    public function transform(TransformerInterface $transformer): string
    {
        $body = $transformer->file() |> Filesystem::get(...) |> $transformer->body(...);

        $transformer->transform($body);

        return $body->toString();
    }

    public function file(string $identity): string
    {
        return Filesystem\Path::join($this->directory(), $identity);
    }

    protected function directory(): string
    {
        return $this->directory ??= static::output();
    }

    protected function lottery(): LotteryInterface
    {
        return $this->lottery ??= Lottery::odds(1, 1000);
    }

    protected static function seed(): string
    {
        return Filesystem\Touch::directory('.storage', Filesystem\Temporary::directory());
    }
}
