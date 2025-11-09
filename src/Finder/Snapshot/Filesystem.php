<?php

namespace Mpietrucha\Utility\Finder\Snapshot;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Filesystem as Adapter;
use Mpietrucha\Utility\Filesystem\Temporary;
use Mpietrucha\Utility\Type;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

class Filesystem extends None implements UtilizableInterface
{
    use Utilizable\Strings;

    /**
     * @var \Mpietrucha\Utility\Collection<string, string>|null
     */
    protected ?Collection $snapshots = null;

    /**
     * Create a new filesystem snapshot tracker with an optional storage file.
     */
    public function __construct(protected ?string $file = null)
    {
    }

    /**
     * Get the current filesystem snapshot hash for the given input path.
     */
    public function get(string $input): ?string
    {
        return Adapter::snapshot($input);
    }

    /**
     * Determine if the snapshot for the given input has expired by comparing with cached value.
     */
    public function expired(string $input): bool
    {
        $snapshot = $this->get($input);

        if (Type::null($snapshot)) {
            return true;
        }

        if ($this->snapshots()->get($input) === $snapshot) {
            return false;
        }

        $this->update(...) |> $this->snapshots()->put($input, $snapshot)->tap(...);

        return true;
    }

    /**
     * Update the snapshot cache file with the current snapshots.
     */
    protected function update(): void
    {
        Adapter::put($this->file(), $this->snapshots()->toJson());
    }

    /**
     * Get the collection of cached snapshots.
     *
     * @return \Mpietrucha\Utility\Collection<string, string>
     */
    protected function snapshots(): Collection
    {
        return $this->snapshots ??= $this->file() |> Adapter::json(...) |> Collection::create(...);
    }

    /**
     * Get the snapshot cache file path.
     */
    protected function file(): string
    {
        return $this->file ??= static::utilize();
    }

    /**
     * Create a temporary file for storing snapshots.
     */
    protected static function hydrate(): string
    {
        return Temporary::file('snapshots.json');
    }
}
