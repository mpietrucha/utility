<?php

namespace Mpietrucha\Utility\Latch\Adapter;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Temporary;
use Mpietrucha\Utility\Filesystem\Touch;
use Mpietrucha\Utility\Latch\Contracts\AdapterInterface;
use Mpietrucha\Utility\Utilizer\Concerns\Utilizable;
use Mpietrucha\Utility\Utilizer\Contracts\UtilizableInterface;

class File implements AdapterInterface, CreatableInterface, UtilizableInterface
{
    use Creatable, Utilizable\Strings;

    /**
     * Create a new file-based latch adapter for the given directory.
     */
    public function __construct(protected ?string $directory = null)
    {
    }

    /**
     * Get the directory used for storing latch files.
     */
    public function directory(): string
    {
        return $this->directory ??= static::utilize();
    }

    /**
     * Get the file path for the given indicator.
     */
    public function get(string $indicator): string
    {
        return Temporary::get($indicator, $this->directory());
    }

    /**
     * Flush all latch files from the storage directory.
     */
    public function flush(): void
    {
        $this->directory() |> Filesystem::deleteDirectory(...);
    }

    /**
     * Determine if the given indicator is currently acquired.
     */
    public function acquired(string $indicator): bool
    {
        return $this->get($indicator) |> Filesystem::exists(...);
    }

    /**
     * Acquire the latch for the given indicator.
     */
    public function acquire(string $indicator): void
    {
        $this->get($indicator) |> Touch::file(...);
    }

    /**
     * Release the latch for the given indicator.
     */
    public function release(string $indicator): void
    {
        $this->get($indicator) |> Filesystem::delete(...);
    }

    /**
     * Hydrate the default latch directory path.
     */
    protected static function hydrate(): string
    {
        return Temporary::directory('latches');
    }
}
