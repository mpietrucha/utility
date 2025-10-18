<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Contracts\RecordInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use SplFileInfo;
use Symfony\Component\Finder\SplFileInfo as Adapter;

class Record extends Adapter implements CreatableInterface, RecordInterface
{
    use Arrayable, Compatible, Creatable, Forwardable, Stringable {
        Compatible::relay insteadof Forwardable;
        Compatible::proxy insteadof Forwardable;
    }

    public function __construct(string $file)
    {
        $input = func_get_args() |> static::transform(...);

        /** @phpstan-ignore-next-line  */
        parent::__construct(...) |> $input->pipeSpread(...);
    }

    /**
     * @param  array<array-key, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        $forward = Filesystem::class |> $this->forward(...);

        return $forward->compose($method, $this->getPathName(), $arguments);
    }

    public static function build(SplFileInfo $adapter): static
    {
        return static::create(...) |> static::normalize($adapter)->pipeSpread(...);
    }

    public function toCollection(): EnumerableInterface
    {
        return static::normalize($this);
    }

    public function toArray(): array
    {
        return $this->toCollection()->toArray();
    }

    public function toString(): string
    {
        return parent::__toString();
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    protected static function normalize(SplFileInfo $adapter): EnumerableInterface
    {
        $input = $adapter->getPathName() |> Collection::create(...);

        if (static::incompatible($adapter)) {
            return $input;
        }

        /** @var \Symfony\Component\Finder\SplFileInfo $adapter */
        return $input->push($adapter->getRelativePath(), $adapter->getRelativePathname());
    }

    /**
     * @param  array<array-key, mixed>  $input
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    protected static function transform(array $input): EnumerableInterface
    {
        return Collection::sequence(3)->replace($input)->mapToStrings();
    }

    protected static function compatibility(SplFileInfo $adapter): bool
    {
        return $adapter instanceof Adapter;
    }
}
