<?php

namespace Mpietrucha\Utility\Finder\Cache;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Finder\Contracts\ValidatorInterface;
use Mpietrucha\Utility\Finder\Result;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stream;

class File extends Fresh
{
    public function __construct(protected ?string $directory = null, ?ValidatorInterface $validator = null)
    {
        parent::__construct($validator);
    }

    public function exists(string $identity): bool
    {
        return $this->file($identity) |> Filesystem::is()->file(...);
    }

    public function delete(string $identity): void
    {
        $this->file($identity) |> Filesystem::delete(...);
    }

    public function get(string $identity): ?EnumerableInterface
    {
        if ($this->unexists($identity)) {
            return null;
        }

        $response = $this->file($identity) |> Filesystem::lines(...);

        return $response->pipeThrough([
            fn (EnumerableInterface $response) => static::delimiter() |> $lines->map->explode(...),
            fn (EnumerableInterface $response) => $lines->keyBy(0),
            fn (EnumerableInterface $response) => $lines->mapSpread(Result::build(...)),
        ]);
    }

    public function set(string $identity, EnumerableInterface $response): void
    {
        $file = $this->file($identity) |> Stream::open(...);

        $response->pipeThrough([
            fn (EnumerableInterface $response) => $response->map->toArray(),
            fn (EnumerableInterface $response) => static::delimiter() |> $response->map->join(...),
            fn (EnumerableInterface $response) => $response->map(Str::eol(...)),
            fn (EnumerableInterface $response) => $response->each($file->write(...)),
        ]);
    }

    protected static function delimiter(): string
    {
        return '|';
    }

    protected function file(string $identity): string
    {
        return Filesystem\Path::absolute($identity, $this->directory());
    }

    protected function directory(?string $base = null, ?string $name = null, int $level = 2): string
    {
        return $this->directory ??= Filesystem\Path::cache($name, $base, $level);
    }
}
