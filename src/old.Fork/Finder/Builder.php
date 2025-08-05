<?php

namespace Mpietrucha\Utility\Finder;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder;
use Mpietrucha\Utility\Finder\Concerns\InteractsWithFinder;
use Mpietrucha\Utility\Finder\Contracts\AdapterInterface;
use Mpietrucha\Utility\Finder\Contracts\BuilderInterface;
use Mpietrucha\Utility\Finder\Contracts\CacheInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Contracts\IdentifierInterface;

class Builder implements BuilderInterface, CreatableInterface
{
    use Creatable, InteractsWithFinder;

    protected ?string $input = null;

    protected ?int $limit = null;

    protected ?int $deepness = null;

    protected ?CacheInterface $cache = null;

    protected ?AdapterInterface $adapter = null;

    protected ?IdentifierInterface $identifier = null;

    public function toArray(): array
    {
        return [
            $this->input,
            $this->limit,
            $this->deepness,
            $this->cache,
            $this->adapter,
            $this->identifier,
        ];
    }

    public function cache(CacheInterface $cache): static
    {
        $this->cache = $cache;

        return $this;
    }

    public function adapter(AdapterInterface $adapter): static
    {
        $this->adapter = $adapter;

        return $this;
    }

    public function identifier(IdentifierInterface $identifier): static
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function get(): FinderInterface
    {
        return Finder::create(...$this->toArray());
    }
}
