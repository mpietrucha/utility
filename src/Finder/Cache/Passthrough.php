<?php

namespace Mpietrucha\Utility\Finder\Cache;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Finder\Contracts\CacheInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Contracts\IdentifierInterface;
use Mpietrucha\Utility\Finder\Contracts\ValidatorInterface;
use Mpietrucha\Utility\Finder\Identifier;
use Mpietrucha\Utility\Finder\Validator;
use Mpietrucha\Utility\Normalizer;

class Passthrough implements CacheInterface, CreatableInterface
{
    use Creatable;

    protected ?string $identify = null;

    public function __construct(protected FinderInterface $finder, protected ?ValidatorInterface $validator = null, protected ?IdentifierInterface $identifier = null)
    {
    }

    public function identify(): string
    {
        return $this->identify ??= $this->identifier()->identify($this->finder());
    }

    public function exists(): bool
    {
        return false;
    }

    final public function unexists(): bool
    {
        return Normalizer::not($this->exists());
    }

    public function flush(): void
    {
    }

    public function validate(): void
    {
        $this->validator()->validate() && $this->flush();
    }

    public function get(): ?EnumerableInterface
    {
        return null;
    }

    public function set(EnumerableInterface $response): void
    {
    }

    protected function finder(): FinderInterface
    {
        return $this->finder;
    }

    protected function validator(): ValidatorInterface
    {
        return $this->validator ??= Validator\Lottery::create();
    }

    protected function identifier(): IdentifierInterface
    {
        return $this->identifier ??= Identifier\Serializable::create();
    }
}
