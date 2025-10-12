<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Fork\Contracts\StorageInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Hash;
use Mpietrucha\Utility\Lottery;
use Mpietrucha\Utility\Lottery\Contracts\LotteryInterface;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;

class Storage implements CreatableInterface, StorageInterface
{
    use Creatable, Utilizable\Strings;

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

        $transformer = Instance\File::get($transformer);

        return Filesystem::hash($file) . Filesystem::hash($file) |> Hash::md5(...);
    }

    public function store(TransformerInterface $transformer): string
    {
        $file = $this->identify($transformer) |> $this->file(...);

        if (Filesystem::exists($file)) {
            return $file;
        }

        Filesystem::put($file, $this->transform($transformer));

        return $file;
    }

    public function transform(TransformerInterface $transformer): string
    {
        $content = $transformer->file() |> Filesystem::get(...) |> $transformer->content(...);

        $transformer->transform($content);

        return $content->toString();
    }

    protected function file(string $identity): string
    {
        return Filesystem\Path::join($this->directory(), $identity);
    }

    protected function directory(): string
    {
        return $this->directory ??= static::utilize();
    }

    protected function lottery(): LotteryInterface
    {
        return $this->lottery ??= Lottery::odds(1, 1000);
    }

    protected static function hydrate(): string
    {
        return Filesystem\Temporary::directory('forks');
    }
}
