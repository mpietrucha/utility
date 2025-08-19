<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Fork\Alias;
use Mpietrucha\Utility\Fork\Contracts\StorageInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Fork\Storage;

class Fork implements CreatableInterface
{
    use Creatable;

    protected static ?Collection $transformers = null;

    public function __construct(protected ?StorageInterface $storage = null)
    {
    }

    public static function bootstrap(): bool
    {
        return static::transformers()->isEmpty() && static::register(...) |> spl_autoload_register(...);
    }

    /**
     * @param  array<int, \Mpietrucha\Utility\Fork\Contracts\TransformerInterface>  $transformers
     */
    public function load(array $transformers): void
    {
        $transformers = Collection::create($transformers)->whereInstanceOf(TransformerInterface::class);

        $this->add(...) |> $transformers->each(...);
    }

    public function add(TransformerInterface $transformer): void
    {
        static::bootstrap();

        if ($transformer->file() |> Filesystem::not()->file(...)) {
            return;
        }

        $this->storage()->validate();

        Alias::transformer($transformer);

        static::transformers()->put($transformer->namespace(), $this->storage()->store($transformer));
    }

    /**
     * @return \Mpietrucha\Utility\Collection<string, string>
     */
    protected static function transformers(): Collection
    {
        return static::$transformers ??= Collection::create();
    }

    protected static function register(string $class): void
    {
        $file = static::transformers()->get($class) ?? Alias::get($class);

        if (Type::null($file)) {
            return;
        }

        Filesystem::requireOnce($file);
    }

    protected function storage(): StorageInterface
    {
        return $this->storage ??= Storage::create();
    }
}
