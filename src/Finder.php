<?php

namespace Mpietrucha\Utility;

use Iterator;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Exclude;
use Mpietrucha\Utility\Illuminate\Arr;
use Mpietrucha\Utility\Illuminate\Contracts\EnumerableInterface;
use Symfony\Component\Finder\Finder as Adapter;

class Finder extends Adapter implements CreatableInterface, FinderInterface
{
    use Creatable;

    public function __construct(protected ?int $iterations = null, protected ?string $cwd = null, protected ?int $quota = 1)
    {
    }

    public function attempts(int $iterations): static
    {
        $this->iterations = $iterations;

        return $this;
    }

    public function until(int $quota): static
    {
        $this->quota = $quota;

        return $this;
    }

    /**
     * @param  string|array<int, string>  $directories
     */
    public function exclude(array|string $directories): static
    {
        return Exclude::create($this->cwd(), $directories)->transform(parent::exclude(...));
    }

    public function getIterator(): Iterator
    {
        $this->hydrate();

        return parent::getIterator();
    }

    public function get(): EnumerableInterface
    {

    }

    protected function hydrate(): void
    {
        $cwd = $this->cwd();

        Arr::empty($this->input()) && Type::string($cwd) && $this->in($cwd);
    }

    protected function cwd(): ?string
    {
        return $this->cwd ??= Filesystem::cwd();
    }

    protected function iterations(): ?int
    {
        return $this->iterations;
    }

    protected function quota(): ?int
    {
        return $this->quota;
    }

    /**
     * @return array<int, string>
     */
    protected function input(): array
    {
        return $this->dirs;
    }
}
