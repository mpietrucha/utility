<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Finder\Adapter;
use Mpietrucha\Utility\Finder\Cache;
use Mpietrucha\Utility\Finder\Contracts\AdapterInterface;
use Mpietrucha\Utility\Finder\Contracts\CacheInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Loop;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;

/**
 * @mixin \Mpietrucha\Utility\Finder\Contracts\AdapterInterface
 */
class Finder implements CreatableInterface, FinderInterface
{
    use Creatable, Forwardable;

    protected ?string $in = null;

    public function __construct(
        protected ?int $depth = null,
        protected ?int $target = null,
        protected ?CacheInterface $cache = null,
        protected ?AdapterInterface $adapter = null,
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

    public function fresh(): static
    {
        $this->cache = Cache\Passthrough::create($this);

        return $this;
    }

    public function attempts(int $depth): static
    {
        $this->depth = $depth;

        return $this;
    }

    public function until(int $target): static
    {
        $this->target = $target;

        return $this;
    }

    public function in(string $in): static
    {
        $this->in = $in;

        return $this;
    }

    public function adapter(): AdapterInterface
    {
        return $this->adapter ??= Adapter\Finder::create();
    }

    public function cache(): CacheInterface
    {
        return $this->cache ??= Cache\File::create($this);
    }

    public function get(): EnumerableInterface
    {
        $this->cache()->validate();

        if ($this->cache()->exists()) {
            return $this->cache()->get();
        }

        $response = Loop::run($this->adapter(), $this->input(), $this->depth(), $this->target());

        $this->cache()->set($response);

        return $response;
    }

    protected function target(): ?int
    {
        return $this->target;
    }

    protected function depth(): ?int
    {
        return $this->depth;
    }

    protected function input(): ?string
    {
        return $this->in ??= Filesystem::cwd();
    }
}
