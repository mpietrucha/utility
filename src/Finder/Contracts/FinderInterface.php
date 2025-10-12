<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Countable;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Symfony\Component\Finder\Finder as Adapter;

/**
 * @method static directories()
 * @method static files()
 * @method static depth(string|int|array<int, int|string> $levels)
 * @method static date(string|array<int, string> $dates)
 * @method static name(string|array<int, string> $patterns)
 * @method static notName(string|array<int, string> $patterns)
 * @method static contains(string|array<int, string> $patterns)
 * @method static notContains(string|array<int, string> $patterns)
 * @method static path(string|array<int, string> $patterns)
 * @method static notPath(string|array<int, string> $patterns)
 * @method static size(string|int|array<int, int|string> $sizes)
 * @method static exclude(string|array<int, string> $dirs)
 * @method static ignoreDotFiles(bool $ignoreDotFiles)
 * @method static ignoreVCS(bool $ignoreVCS)
 * @method static ignoreVCSIgnored(bool $ignoreVCSIgnored)
 * @method static addVCSPattern(string|array<int, string> $pattern)
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
    public static function builder(): BuilderInterface;

    public function adapter(): Adapter;

    public function cache(): CacheInterface;

    public function identifier(): IdentifierInterface;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<string, \Mpietrucha\Utility\Filesystem\Contracts\RecordInterface>
     */
    public function get(): EnumerableInterface;
}
