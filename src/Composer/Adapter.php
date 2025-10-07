<?php

namespace Mpietrucha\Utility\Composer;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;

class Adapter extends \Illuminate\Support\Composer implements CreatableInterface
{
    use Creatable;

    public function __construct(?string $cwd = null)
    {
        parent::__construct(Filesystem::adapter(), $cwd);
    }

    public function findComposerFile(): string
    {
        return parent::findComposerFile();
    }
}
