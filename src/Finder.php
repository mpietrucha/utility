<?php

namespace Mpietrucha\Utility;

use Closure;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Finder\Builder;
use Mpietrucha\Utility\Finder\Cache;
use Mpietrucha\Utility\Finder\Concerns\InteractsWithFinder;
use Mpietrucha\Utility\Finder\Contracts\BuilderInterface;
use Mpietrucha\Utility\Finder\Contracts\CacheInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Contracts\IdentifierInterface;
use Mpietrucha\Utility\Finder\Identifier;
use Mpietrucha\Utility\Finder\Loop;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use Symfony\Component\Finder\Finder as Adapter;

/**
 * @mixin \Symfony\Component\Finder\Finder
 */
class Finder implements CreatableInterface, FinderInterface
{
    use Creatable, Forwardable, InteractsWithFinder;

    public function __construct(
        protected ?string $input = null,
        protected ?int $altitude = null,
        protected ?Adapter $adapter = null,
        protected ?CacheInterface $cache = null,
        protected ?IdentifierInterface $identifier = null,
    ) {
    }

    /**
     * @param  array<int|string, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): static
    {
        $adapter = $this->adapter();

        $this->forward($adapter)->eval($method, $arguments);

        return $this;
    }

    public static function builder(): BuilderInterface
    {
        return Builder::create();
    }

    public static function uncached(?Closure $configuration = null): static
    {
        $builder = Cache\None::create() |> static::builder()->cache(...);

        return $builder->tap($configuration)->build();
    }

    public function adapter(): Adapter
    {
        return $this->adapter ??= Adapter::create()->ignoreUnreadableDirs();
    }

    public function cache(): CacheInterface
    {
        return $this->cache ??= Cache\File::create();
    }

    public function identifier(): IdentifierInterface
    {
        return $this->identifier ??= Identifier\Hash::create();
    }

    public function get(): EnumerableInterface
    {
        $this->cache()->validate($identity = $this->identity(), $this->summit());

        if ($response = $this->cache()->get($identity)) {
            return $response;
        }

        $this->cache()->set($identity, $response = $this->run());

        return $response;
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\ElementInterface>
     */
    protected function run(): EnumerableInterface
    {
        return Loop::run($this->adapter(), $this->input(), $this->altitude());
    }

    protected function input(): string
    {
        return $this->input ??= Filesystem::cwd() |> Normalizer::string(...);
    }

    protected function altitude(): ?int
    {
        return $this->altitude;
    }

    protected function identity(): string
    {
        return $this->identifier()->identify($this);
    }

    protected function summit(): string
    {
        return Filesystem\Path::directory($this->input(), $this->altitude());
    }
}
