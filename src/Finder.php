<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem\Cwd;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Finder\Builder;
use Mpietrucha\Utility\Finder\Cache\File;
use Mpietrucha\Utility\Finder\Cache\None;
use Mpietrucha\Utility\Finder\Concerns\InteractsWithFinder;
use Mpietrucha\Utility\Finder\Contracts\BuilderInterface;
use Mpietrucha\Utility\Finder\Contracts\CacheInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Contracts\IdentifierInterface;
use Mpietrucha\Utility\Finder\Identifier\Hash;
use Mpietrucha\Utility\Finder\Loop;
use Mpietrucha\Utility\Finder\Reflection;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use Symfony\Component\Finder\Finder as Adapter;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
class Finder implements CreatableInterface, FinderInterface
{
    use Creatable, Forwardable, InteractsWithFinder;

    /**
     * Create a new finder instance.
     */
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
     * Dynamically forward method calls to the adapter instance.
     *
     * @param  MixedArray  $arguments
     */
    public function __call(string $method, array $arguments): static
    {
        $forward = $this->adapter() |> $this->forward(...);

        $forward->eval($method, $arguments);

        return $this;
    }

    /**
     * Create a new finder builder instance.
     */
    public static function builder(): BuilderInterface
    {
        return Builder::create();
    }

    /**
     * Create an uncached finder instance with optional configuration.
     */
    public static function uncached(?callable $configuration = null): static
    {
        $builder = None::create() |> static::builder()->cache(...);

        return $builder->tap($configuration)->build();
    }

    /**
     * Get the underlying Symfony Finder adapter instance.
     */
    public function adapter(): Adapter
    {
        return $this->adapter ??= Adapter::create();
    }

    /**
     * Get the cache instance for storing finder results.
     */
    public function cache(): CacheInterface
    {
        return $this->cache ??= File::create();
    }

    /**
     * Get the identifier instance for generating cache keys.
     */
    public function identifier(): IdentifierInterface
    {
        return $this->identifier ??= Hash::create();
    }

    /**
     * Get the finder results, using cache when available.
     */
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
     * Count the number of items found.
     */
    public function count(): int
    {
        return $this->get()->count();
    }

    /**
     * Execute the finder and return the results.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface>
     */
    protected function run(): EnumerableInterface
    {
        return Loop::run($this->adapter(), $this->input(), $this->altitude());
    }

    /**
     * Get the input directory path for the finder.
     */
    protected function input(): string
    {
        return $this->input ??= Cwd::get();
    }

    /**
     * Get the altitude (depth) for directory traversal.
     */
    protected function altitude(): ?int
    {
        return $this->altitude;
    }

    /**
     * Generate a unique identity string for cache identification.
     */
    protected function identity(): string
    {
        return $this->identifier()->identify($this);
    }

    /**
     * Get the summit directory path based on input and altitude.
     */
    protected function summit(): string
    {
        return Path::directory($this->input(), $this->altitude());
    }
}
