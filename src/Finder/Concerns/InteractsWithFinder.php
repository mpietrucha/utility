<?php

namespace Mpietrucha\Utility\Finder\Concerns;

use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Finder\Exception\FinderAppendException;

trait InteractsWithFinder
{
    public function in(string $input, ?string $directory = null): static
    {
        $this->input = Path::build($input, $directory);

        return $this;
    }

    public function append(): static
    {
        FinderAppendException::for($this)->throw();
    }

    public function climb(int $altitude = PHP_INT_MAX): static
    {
        $this->altitude = $altitude;

        return $this;
    }
}
