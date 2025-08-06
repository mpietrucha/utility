<?php

namespace Mpietrucha\Utility;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Finder\Adapter;
use Mpietrucha\Utility\Finder\Builder;
use Mpietrucha\Utility\Finder\Cache;
use Mpietrucha\Utility\Finder\Concerns\InteractsWithFinder;
use Mpietrucha\Utility\Finder\Contracts\AdapterInterface;
use Mpietrucha\Utility\Finder\Contracts\BuilderInterface;
use Mpietrucha\Utility\Finder\Contracts\CacheInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Contracts\IdentifierInterface;
use Mpietrucha\Utility\Finder\Identifier;
use Mpietrucha\Utility\Finder\Loop;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;

/**
 * @mixin \Mpietrucha\Utility\Finder\Contracts\AdapterInterface
 */
class Finder implements CreatableInterface, FinderInterface
{
    use Creatable, Forwardable, InteractsWithFinder;

    protected ?string $identity = null;

    public function __construct(
        protected ?string $input = null,
        protected ?int $limit = null,
        protected ?int $deepness = null,
        protected ?CacheInterface $cache = null,
        protected ?AdapterInterface $adapter = null,
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

    public function adapter(): AdapterInterface
    {
        return $this->adapter ??= Adapter\Finder::create();
    }

    public function cache(): CacheInterface
    {
        return $this->cache ??= Cache\File::create();
    }

    public function identifier(): IdentifierInterface
    {
        return $this->identifier ??= Identifier\Serializable::create();
    }

    public function get(): EnumerableInterface
    {
        $this->cache()->validate($identity = $this->identity());

        if ($response = $this->cache()->get($identity)) {
            return $response;
        }

        $this->cache()->set($identity, $response = $this->run());

        return $response;
    }

    protected function run(): EnumerableInterface
    {
        return Loop::run($this->adapter(), $this->input(), $this->limit(), $this->deepness());
    }

    protected function input(): ?string
    {
        return $this->input ??= Filesystem::cwd();
    }

    protected function limit(): ?int
    {
        return $this->limit;
    }

    protected function deepness(): ?int
    {
        return $this->deepness;
    }

    protected function identity(): string
    {
        return $this->identity ??= $this->identifier()->identify($this);
    }
}
