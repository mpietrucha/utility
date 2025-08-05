<?php

namespace Mpietrucha\Utility\Finder\Cache;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Finder\Contracts\CacheInterface;
use Mpietrucha\Utility\Finder\Contracts\ValidatorInterface;
use Mpietrucha\Utility\Finder\Validator;
use Mpietrucha\Utility\Normalizer;

class Fresh implements CacheInterface, CreatableInterface
{
    use Creatable;

    public function __construct(protected ?ValidatorInterface $validator = null)
    {
    }

    public function exists(string $identity): bool
    {
        return false;
    }

    final public function unexists(string $identity): bool
    {
        return $this->exists($identity) |> Normalizer::not(...);
    }

    public function validate(string $identity): void
    {
        $this->validator()->due() && $this->delete($identity);
    }

    public function delete(string $identity): void
    {
    }

    public function get(string $identity): ?EnumerableInterface
    {
        return null;
    }

    public function set(string $identity, EnumerableInterface $response): void
    {
    }

    protected function validator(): ValidatorInterface
    {
        return $this->validator ??= Validator\Lottery::create();
    }
}
