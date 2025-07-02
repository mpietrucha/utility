<?php

namespace Mpietrucha\Utility\Finder\Cache;

use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Path;
use Mpietrucha\Utility\Finder\Contracts\FileInterface as ResultInterface;
use Mpietrucha\Utility\Finder\Contracts\FinderInterface;
use Mpietrucha\Utility\Finder\Contracts\IdentifierInterface;
use Mpietrucha\Utility\Finder\Contracts\ValidatorInterface;
use Mpietrucha\Utility\Finder\File as Result;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Stream;

class File extends Passthrough
{
    protected ?string $file = null;

    public function __construct(FinderInterface $finder, ?ValidatorInterface $validator = null, ?IdentifierInterface $identifier = null, protected ?string $directory = null)
    {
        parent::__construct($finder, $validator, $identifier);
    }

    public static function delimiter(): string
    {
        return '|';
    }

    public function exists(): bool
    {
        return Filesystem::is()->file($this->file());
    }

    public function flush(): void
    {
        $this->exists() && Filesystem::delete($this->file());
    }

    public function get(): ?EnumerableInterface
    {
        if ($this->unexists()) {
            return null;
        }

        /** @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\FileInterface> */
        return $this->lines()->mapSpread(Result::build(...));
    }

    public function set(EnumerableInterface $response): void
    {
        Filesystem::ensureDirectoryExists($this->directory());

        $output = Stream::open($this->file(), 'w');

        $this->entries($response)->each($output->write(...));
    }

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, array<int, string>>
     */
    protected function lines(): EnumerableInterface
    {
        $file = $this->file();

        return Filesystem::lines($file)->map->explode(static::delimiter())->keyBy(0);
    }

    /**
     * @param  \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Finder\Contracts\FileInterface>  $response
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, string>
     */
    protected function entries(EnumerableInterface $response): EnumerableInterface
    {
        $files = $response->map($this->entry(...))->map(Collection::create(...));

        return $files->map->join(static::delimiter())->map(Str::eol(...));
    }

    /**
     * @return array<int, string>
     */
    protected function entry(ResultInterface $result): array
    {
        return [
            $result->get(),
            $result->adapter()->getRelativePath(),
            $result->adapter()->getRelativePathname(),
        ];
    }

    protected function file(): string
    {
        return $this->file ??= Path::absolute($this->identify(), $this->directory());
    }

    protected function directory(): string
    {
        return $this->directory ??= Path::absolute('../.cache', __DIR__);
    }
}
