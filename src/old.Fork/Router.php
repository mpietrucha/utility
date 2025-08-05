<?php

namespace Mpietrucha\Utility\Fork;

use Illuminate\Support\Lottery;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Fork\Contracts\TransformerInterface;
use Mpietrucha\Utility\Instance;
use Mpietrucha\Utility\Type;

class Router implements CreatableInterface
{
    use Creatable;

    protected static ?Collection $transformers = null;

    /**
     * @param  array<int, \Mpietrucha\Utility\Fork\Contracts\TransformerInterface>  $transformers
     */
    public function __construct(?array $transformers, protected ?int $odds = null)
    {
        $this->add($transformers);
    }

    public static function bootstrap(): bool
    {
        static::transformers()->isEmpty() && spl_autoload_register(static::register(...));
    }

    /**
     * @param  array<int, \Mpietrucha\Utility\Fork\Contracts\TransformerInterface>  $transformers
     */
    public function add(array $transformers): void
    {
        $transformers = Collection::create($transformers)->whereInstanceOf(TransformerInterface::class);

        $transformers->each($this->store(...));
    }

    public function store(TransformerInterface $transformer): void
    {
        static::bootstrap();

        if (Instance::unexists($transformer->class())) {
            return;
        }

        $storage = $transformer->storage();

        Lottery::odds(1, $this->odds())->choose() && $storage->flush();

        $storage->validate();

        static::transformers()->put($transformer->namespace(), $storage->file());
    }

    protected function odds(): ?int
    {
        return $this->odds ??= 1000;
    }

    /**
     * @return \Mpietrucha\Utility\Collection<string, string>
     */
    protected static function transformers(): Collection
    {
        return static::$transformers ??= Collection::create();
    }

    protected static function register(stirng $class): void
    {
        $transformer = static::transformers()->get($class);

        if (Type::null($transformer)) {
            return;
        }

        Filesystem::requireOnce($transformer);
    }
}
