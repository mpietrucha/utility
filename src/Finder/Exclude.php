<?php

namespace Mpietrucha\Utility\Finder;

use Closure;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Transformable;
use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\TransformableInterface;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Illuminate\Arr;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Type;

/**
 * @property null|string|array<int, string> $directories
 *
 * @implements \Mpietrucha\Utility\Contracts\ArrayableInterface<int, string>
 */
class Exclude implements ArrayableInterface, CreatableInterface, TransformableInterface
{
    use Creatable, Transformable;

    /**
     * @param  null|string|array<int, string>  $directories
     */
    public function __construct(protected ?string $cwd = null, protected null|array|string $directories = null)
    {
    }

    public function toArray(): array
    {
        return Arr::map($this->directories(), $this->get(...));
    }

    public function get(string $directory): string
    {
        $cwd = $this->cwd();

        return Type::string($cwd) ? Path::relative($directory, $cwd) : $directory;
    }

    protected function cwd(): ?string
    {
        return $this->cwd;
    }

    /**
     * @return array<int, string>
     */
    protected function directories(): array
    {
        return Normalizer::array($this->directories);
    }

    protected function transformable(): Closure
    {
        return $this->toArray(...);
    }
}
