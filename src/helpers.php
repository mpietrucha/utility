<?php

namespace Mpietrucha\Support;

use Illuminate\Support\Arr;
use Mpietrucha\Support\Exception\BadMethodCallException;

function collect_config(string $key): mixed
{
    BadMethodCallException::create()->unless(function () {
        return function_exists('config') && function_exists('collect');
    })->throw('Cannot use [collect_config] outside Laravel instalation.');

    $value = config($key);

    if (Type::create($value)->not()->array()) {
        return $value;
    }

    return collect($value);
}

function class_extends(mixed $class, string $search): bool
{
    return Rescue::create(is_subclass_of(...))->whenFailsReturnFalse()($class, $search);
}

function class_implements_interface(mixed $class, string $search): bool
{
    $implements = Rescue::create(class_implements(...))->whenFailsReturnEmptyArray()($class);

    return Arr::has($implements, $search);
}

function class_uses_trait(mixed $class, string $search): bool
{
    $uses = Rescue::create(class_uses_recursive(...))->whenFailsReturnEmptyArray()($class);

    return Arr::has($uses, $search);
}

function trait_uses_trait(mixed $trait, string $search): bool
{
    $uses = Rescue::create(trait_uses_recursive(...))->whenFailsReturnEmptyArray()($trait);

    return Arr::has($uses, $search);
}
