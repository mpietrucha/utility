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

    public function __construct(protected ?string $file = null)
    {
    }

    public function get(string $input): ?string
    {
        return Adapter::snapshot($input);
    }

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

    protected function update(): void
    {
        Adapter::put($this->file(), $this->snapshots()->toJson());
    }

    /**
     * @return \Mpietrucha\Utility\Collection<string, string>
     */
    protected function snapshots(): Collection
    {
        return $this->snapshots ??= $this->file() |> Adapter::json(...) |> Collection::create(...);
    }

    protected function file(): string
    {
        return $this->file ??= static::utilize();
    }

    protected static function hydrate(): string
    {
        return Temporary::file('snapshots.json');
    }
}
