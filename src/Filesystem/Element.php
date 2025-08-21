<?php

namespace Mpietrucha\Utility\Filesystem;

use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Contracts\ElementInterface;
use Mpietrucha\Utility\Forward\Concerns\Forwardable;
use Mpietrucha\Utility\Normalizer;
use Symfony\Component\Finder\SplFileInfo;

class Element extends SplFileInfo implements CreatableInterface, ElementInterface
{
    use Creatable, Forwardable, Stringable;

    public function __construct(string $filename, ?string $relativePath = null, ?string $relativePathname = null)
    {
        [$relativePath, $relativePathname] = [Normalizer::string($relativePath), Normalizer::string($relativePathname)];

        parent::__construct($filename, $relativePath, $relativePathname);
    }

    /**
     * @param  array<int, mixed>  $arguments
     */
    public function __call(string $method, array $arguments): mixed
    {
        return $this->forward(Filesystem::class)->get($method, $this->toString(), ...$arguments);
    }

    public function toString(): string
    {
        return parent::__toString();
    }

    public function toArray(): array
    {
        return [
            $this->toString(),
            $this->getRelativePath(),
            $this->getRelativePathname(),
        ];
    }
}
