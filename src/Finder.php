<?php

namespace Mpietrucha\Utility;

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
use Mpietrucha\Utility\Finder\Reflection;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use Symfony\Component\Finder\Finder as Adapter;

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
        Type::string($input) && $this->in($input);

        Reflection::refresh($adapter);

        $this->adapter()->ignoreUnreadableDirs();
    }

    /**
     * @param  array<array-key, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): static
    {
        $forward = $this->adapter() |> $this->forward(...);

        $forward->eval($method, $arguments);

        return $this;
    }

    public static function builder(): BuilderInterface
    {
        return Builder::create();
    }

    public static function uncached(?callable $configuration = null): static
    {
        $builder = Cache\None::create() |> static::builder()->cache(...);

        return $builder->tap($configuration)->build();
    }

    public function adapter(): Adapter
    {
        return $this->adapter ??= Adapter::create();
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

    public function count(): int
    {
        return $this->get()->count();
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface>
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
