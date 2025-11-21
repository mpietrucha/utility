<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Contracts\RecordInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use SplFileInfo;
use Symfony\Component\Finder\SplFileInfo as Adapter;

/**
 * @phpstan-import-type MixedArray from \Mpietrucha\Utility\Arr
 */
class Record extends Adapter implements CompatibleInterface, CreatableInterface, RecordInterface
{
    use Arrayable, Compatible, Creatable, Forwardable, Stringable {
        Compatible::relay insteadof Forwardable;
        Compatible::proxy insteadof Forwardable;
    }

    /**
     * Create a new filesystem record for the given file path.
     */
    public function __construct(string $file)
    {
        $input = func_get_args() |> static::transform(...);

        parent::__construct(...) |> $input->pipeSpread(...);
    }

    /**
     * Forward filesystem method calls using the file path.
     *
     * @param  MixedArray  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        $forward = Filesystem::class |> $this->forward(...);

        return $forward->compose($method, $this->getPathName(), $arguments);
    }

    /**
     * Build a record from an SplFileInfo adapter.
     */
    public static function build(SplFileInfo $adapter): static
    {
        return static::create(...) |> static::normalize($adapter)->pipeSpread(...);
    }

    /**
     * Convert the record to a collection.
     */
    public function toCollection(): EnumerableInterface
    {
        return static::normalize($this);
    }

    /**
     * Convert the record to an array.
     */
    public function toArray(): array
    {
        return $this->toCollection()->toArray();
    }

    /**
     * Convert the record to its string representation.
     */
    public function toString(): string
    {
        return parent::__toString();
    }

    /**
     * Normalize the SplFileInfo adapter to a collection of path components.
     *
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
     * Transform constructor arguments into a normalized collection of strings.
     *
     * @param  MixedArray  $input
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    protected static function transform(array $input): EnumerableInterface
    {
        return Collection::sequence(3)->replace($input)->mapToStrings();
    }

    /**
     * Determine if the adapter is compatible with extended file info.
     */
    protected static function compatibility(SplFileInfo $adapter): bool
    {
        return $adapter instanceof Adapter;
    }
}
