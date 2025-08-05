<?php

namespace Mpietrucha\Utility\Finder\Concerns;

use Mpietrucha\Utility\Finder\Cache;

trait InteractsWithFinder
{
    public function fresh(bool $fresh = true): static
    {
        $fresh && $this->cache = Cache\Fresh::create();

        return $this;
    }

    public function in(string $input): static
    {
        $this->input = $input;

        return $this;
    }

    public function quota(int $limit): static
    {
        $this->limit = $limit;

        return $this;
    }

    public function depth(int $deepness): static
    {
        $this->deepness = $deepness;

        return $this;
    }

    public function flat(): static
    {
        return $this->depth(1);
    }
}
