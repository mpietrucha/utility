<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Countable;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Symfony\Component\Finder\Finder as Adapter;

/**
 * @method static directories()
 * @method static files()
 * @method static depth(string|int|list<int|string> $levels)
 * @method static date(string|list<string> $dates)
 * @method static name(string|list<string> $patterns)
 * @method static notName(string|list<string> $patterns)
 * @method static contains(string|list<string> $patterns)
 * @method static notContains(string|list<string> $patterns)
 * @method static path(string|list<string> $patterns)
 * @method static notPath(string|list<string> $patterns)
 * @method static size(string|int|list<int|string> $sizes)
 * @method static exclude(string|list<string> $dirs)
 * @method static ignoreDotFiles(bool $ignoreDotFiles)
 * @method static ignoreVCS(bool $ignoreVCS)
 * @method static ignoreVCSIgnored(bool $ignoreVCSIgnored)
 * @method static addVCSPattern(string|list<string> $pattern)
 * @method static sort(\Closure $closure)
 * @method static sortByExtension()
 * @method static sortByName(bool $useNaturalSort = false)
 * @method static sortByCaseInsensitiveName(bool $useNaturalSort = false)
 * @method static sortBySize()
 * @method static sortByType()
 * @method static sortByAccessedTime()
 * @method static reverseSorting()
 * @method static sortByChangedTime()
 * @method static sortByModifiedTime()
 * @method static filter(\Closure $closure, bool $prune = false)
 * @method static followLinks()
 * @method static ignoreUnreadableDirs(bool $ignore = true)
 */
interface FinderInterface extends Countable, InteractsWithFinderInterface
{
    /**
     * Get a new finder builder instance.
     */
    public static function builder(): BuilderInterface;

    /**
     * Get the underlying Symfony Finder adapter.
     */
    public function adapter(): Adapter;

    /**
     * Get the cache instance.
     */
    public function cache(): CacheInterface;

    /**
     * Get the identifier instance.
     */
    public function identifier(): IdentifierInterface;

    /**
     * Get the finder results.
     *
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface>
     */
    public function get(): EnumerableInterface;
}
