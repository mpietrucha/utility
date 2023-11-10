<?php

namespace Mpietrucha\Support;

use Illuminate\Support\Collection;
use Mpietrucha\Support\Concerns\Factoryable;
use Composer\ClassMapGenerator\ClassMapGenerator as Handler;

class ClassMapGenerator
{
    use Factoryable;

    protected array $source;

    protected ?Collection $result = null;

    public function __construct(string|array ...$source)
    {
        $this->source = $source;
    }

    public function namespaces(): Collection
    {
        return $this->get()->keys();
    }

    public function paths(): Collection
    {
        return $this->get()->values();
    }

    public function get(): Collection
    {
        return $this->result ??= collect($this->source)
            ->filter()
            ->map(Handler::createMap(...))
            ->collapse();
    }
}
