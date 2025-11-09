<?php

namespace Mpietrucha\Utility\Finder\Concerns;

use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Finder\Exception\FinderAppendException;

/**
 * @phpstan-require-implements \Mpietrucha\Utility\Finder\Contracts\InteractsWithFinderInterface
 */
trait InteractsWithFinder
{
    /**
     * Set the input directory path for the finder search.
     */
    public function in(string $input, ?string $directory = null): static
    {
        $this->input = Path::build($input, $directory);

        return $this;
    }

    /**
     * Throw an exception when attempting to append to a finder.
     */
    public function append(): static
    {
        FinderAppendException::for($this)->throw();
    }

    /**
     * Set the altitude limit for climbing parent directories.
     */
    public function climb(int $altitude = PHP_INT_MAX): static
    {
        $this->altitude = $altitude;

        return $this;
    }
}
