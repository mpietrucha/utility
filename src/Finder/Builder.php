<?php

namespace Mpietrucha\Utility\Finder;

use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Tappable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder;
use Mpietrucha\Utility\Finder\Concerns\InteractsWithFinder;
use Mpietrucha\Utility\Finder\Contracts\BuilderInterface;
use Mpietrucha\Utility\Finder\Contracts\CacheInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Contracts\IdentifierInterface;
use Symfony\Component\Finder\Finder as Adapter;

class Builder implements BuilderInterface, CreatableInterface
{
    use Arrayable, Creatable, InteractsWithFinder, Tappable;

    protected ?string $input = null;

    protected ?int $altitude = null;

    protected ?Adapter $adapter = null;

    protected ?CacheInterface $cache = null;

    protected ?IdentifierInterface $identifier = null;

    public function toArray(): array
    {
        return [
            $this->input,
            $this->altitude,
            $this->adapter,
            $this->cache,
            $this->identifier,
        ];
    }

    public function cache(CacheInterface $cache): static
    {
        $this->cache = $cache;

        return $this;
    }

    public function adapter(Adapter $adapter): static
    {
        $this->adapter = $adapter;

        return $this;
    }

    public function identifier(IdentifierInterface $identifier): static
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function build(): FinderInterface
    {
        return Finder::create(...) |> $this->toCollection()->pipeSpread(...);
    }
}
