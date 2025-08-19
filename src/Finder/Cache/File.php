<?php

namespace Mpietrucha\Utility\Finder\Cache;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Finder\Contracts\ImprintInterface;
use Mpietrucha\Utility\Finder\Imprint;
use Mpietrucha\Utility\Finder\Result;
use Mpietrucha\Utility\Lottery;
use Mpietrucha\Utility\Lottery\Contracts\LotteryInterface;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stream;

class File extends None
{
    public function __construct(
        protected ?string $directory = null,
        protected ?LotteryInterface $lottery = null,
        protected ?ImprintInterface $imprint = null,
    ) {
    }

    public function flush(): void
    {
        $this->directory() |> Filesystem::cleanDirectory(...);
    }

    public function exists(string $identity): bool
    {
        return $this->file($identity) |> Filesystem::is()->file(...);
    }

    public function delete(string $identity): void
    {
        $this->file($identity) |> Filesystem::delete(...);
    }

    public function validate(string $identity, string $summit): void
    {
        $this->flush(...) |> $this->lottery()->wins(...);

        $this->imprint()->expired($summit) && $this->delete($identity);
    }

    public function get(string $identity): ?EnumerableInterface
    {
        if ($this->unexists($identity)) {
            return null;
        }

        $response = $this->file($identity) |> Filesystem::lines(...);

        return $response->pipeThrough([
            fn (EnumerableInterface $response) => Str::tab() |> $response->map->explode(...),
            fn (EnumerableInterface $response) => $response->keyBy(0),
            fn (EnumerableInterface $response) => Result::build(...) |> $response->mapSpread(...),
        ]);
    }

    public function set(string $identity, EnumerableInterface $response): void
    {
        $file = $this->file($identity) |> Stream::open(...);

        $response->pipeThrough([
            fn (EnumerableInterface $response) => $response->of()->collections(),
            fn (EnumerableInterface $response) => Str::tab() |> $response->map->join(...),
            fn (EnumerableInterface $response) => Str::eol(...) |> $response->map(...),
            fn (EnumerableInterface $response) => Str::trim(...) |> $response->replaceFirst(...),
            fn (EnumerableInterface $response) => $file->write(...) |> $response->each(...),
        ]);
    }

    protected function file(string $identity): string
    {
        return Filesystem\Path::join($this->directory(), $identity);
    }

    protected function directory(): string
    {
        return $this->directory ??= Filesystem\Touch::directory('../.cache', __DIR__);
    }

    protected function lottery(): LotteryInterface
    {
        return $this->lottery ??= Lottery::odds(1, 1000);
    }

    protected function imprint(): ImprintInterface
    {
        return $this->imprint ??= Imprint\Timestamp::create();
    }
}
