<?php

namespace Mpietrucha\Utility\Finder\Contracts;

use Closure;
use Countable;
use IteratorAggregate;
use Mpietrucha\Utility\Contracts\CreatableInterface;

/**
 * @extends \IteratorAggregate<string, \Symfony\Component\Finder\SplFileInfo>
 */
interface AdapterInterface extends Countable, CreatableInterface, IteratorAggregate
{
    public function directories(): static;

    public function files(): static;

    /**
     * @param  int|string|array<int, string>|array<int, int>  $levels
     */
    public function depth(array|int|string $levels): static;

    /**
     * @param  string|array<int, string>  $dates
     */
    public function date(array|string $dates): static;

    /**
     * @param  string|array<int, string>  $patterns
     */
    public function name(array|string $patterns): static;

    /**
     * @param  string|array<int, string>  $patterns
     */
    public function notName(array|string $patterns): static;

    /**
     * @param  string|array<int, string>  $patterns
     */
    public function contains(array|string $patterns): static;

    /**
     * @param  string|array<int, string>  $patterns
     */
    public function notContains(array|string $patterns): static;

    /**
     * @param  string|array<int, string>  $patterns
     */
    public function path(array|string $patterns): static;

    /**
     * @param  string|array<int, string>  $patterns
     */
    public function notPath(array|string $patterns): static;

    /**
     * @param  int|string|array<int, string>|array<int, int>  $sizes
     */
    public function size(array|int|string $sizes): static;

    /**
     * @param  string|array<int, string>  $dirs
     */
    public function exclude(array|string $dirs): static;

    public function ignoreDotFiles(bool $ignoreDotFiles): static;

    public function ignoreVCS(bool $ignoreVCS): static;

    public function ignoreVCSIgnored(bool $ignoreVCSIgnored): static;

    public function sort(Closure $closure): static;

    public function sortByExtension(): static;

    public function sortByName(bool $useNaturalSort = false): static;

    public function sortByCaseInsensitiveName(bool $useNaturalSort = false): static;

    public function sortBySize(): static;

    public function sortByType(): static;

    public function sortByAccessedTime(): static;

    public function reverseSorting(): static;

    public function sortByChangedTime(): static;

    public function sortByModifiedTime(): static;

    public function filter(Closure $closure, bool $prune = false): static;

    public function followLinks(): static;

    public function ignoreUnreadableDirs(bool $ignore = true): static;

    /**
     * @param  string|array<int, string>  $dirs
     */
    public function in(array|string $dirs): static;

    /**
     * @param  iterable<int, string>  $iterator
     */
    public function append(iterable $iterator): static;

    public function hasResults(): bool;
}
