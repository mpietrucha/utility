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
        [$delimiter, $key] = [static::delimiter(), 0];

        if ($this->unexists($identity)) {
            return null;
        }

        $lines = $this->file($identity) |> Filesystem::lines(...);

        return $lines->map->explode($delimiter)->keyBy($key)->mapSpread(Result::build(...));
    }

    public function set(string $identity, EnumerableInterface $response): void
    {
        [$delimiter, $eol] = [static::delimiter(), Str::eol(...)];

        $output = $this->file($identity) |> Stream::open(...);

        $response->map->toArray()->map->join($delimiter)->map($eol)->each($output->write(...));
    }

    protected static function delimiter(): string
    {
        return '|';
    }

    protected function file(string $identity): string
    {
        return Filesystem\Path::absolute($identity, $this->directory());
    }

    protected function directory(): string
    {
        return $this->directory ??= Filesystem\Cache::directory();
    }
}
