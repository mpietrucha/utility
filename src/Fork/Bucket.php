<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Fork\Contracts\StorageInterface;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Type;

class Bucket implements CreatableInterface
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
        $fork = static::transformers()->get($class);

        if (Type::null($fork)) {
            return;
        }

        Filesystem::requireOnce($fork);
    }

    protected function storage(): StorageInterface
    {
        return $this->storage ??= Storage::create();
    }
}
