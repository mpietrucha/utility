<?php

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder;
use Mpietrucha\Utility\Finder\Contracts\AdapterInterface;
use Mpietrucha\Utility\Finder\Contracts\BuilderInterface;
use Mpietrucha\Utility\Finder\Contracts\CacheInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;

class Builder implements BuilderInterface, CreatableInterface
{
    use Creatable;

    protected ?int $attempts = null;

    protected ?int $until = null;

    protected ?CacheInterface $cache = null;

    protected ?AdapterInterface $adapter = null;

    public function toArray(): array
    {
        return [
            $this->attempts,
            $this->until,
            $this->cache,
            $this->adapter,
        ];
    }

    public function attempts(int $attempts): self
    {
        $this->attempts = $attempts;

        return $this;
    }

    public function until(int $until): self
    {
        $this->until = $until;

        return $this;
    }

    public function cache(CacheInterface $cache): self
    {
        $this->cache = $cache;

        return $this;
    }

    public function adapter(AdapterInterface $adapter): self
    {
        $this->adapter = $adapter;

        return $this;
    }

    public function get(): FinderInterface
    {
        return Finder::create(...$this->toArray());
    }
}
