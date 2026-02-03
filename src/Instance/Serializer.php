<?php

namespace Mpietrucha\Utility\Instance;

use Laravel\SerializableClosure\SerializableClosure;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Instance\Serializer\Native;
use Mpietrucha\Utility\Value;

class Serializer extends SerializableClosure implements CreatableInterface
{
    use Creatable;

    /**
     * Create a new serializer wrapper for the given callable or object.
     */
    public function __construct(callable|object $data)
    {
        Value::identity($data) |> parent::__construct(...);
    }

    /**
     * Serialize a callable or object to a string representation.
     */
    public static function serialize(callable|object $data): string
    {
        return static::create($data) |> Native::serialize(...);
    }

    /**
     * Unserialize a string back to an object.
     */
    public static function unserialize(string $data): object
    {
        $data = Native::unserialize($data);

        return match (true) {
            $data instanceof static => Value::for($data)->get(),
            default => $data
        };
    }
}
