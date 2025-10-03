<?php

namespace Mpietrucha\Utility\Finder\Concerns;

use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Finder\Exception\AppendException;

trait InteractsWithFinder
{
    public function in(string $input, ?string $base = null): static
    {
        $this->input = Path::build($input, $base);

        return $this;
    }

    public function append(): static
    {
        AppendException::for($this)->throw();
    }

    public function climb(int $altitude = PHP_INT_MAX): static
    {
        $this->altitude = $altitude;

        return $this;
    }
}
