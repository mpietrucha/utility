<?php

namespace Mpietrucha\Utility\Fork;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Finder;
use Mpietrucha\Utility\Fork\Contracts\StorageInterface;

class Storage implements CreatableInterface, StorageInterface
{
    use Creatable;

    public function flush(): void
    {
        Finder::create($this->directory())
            ->fresh()
            ->flat()
            ->files()
            ->contains($this->transformer()->namespace())
            ->get()
            ->each
            ->delete();
    }
}
