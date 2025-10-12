<?php

namespace Mpietrucha\Utility\Instance;

use Laravel\SerializableClosure\SerializableClosure;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Value;

class Serializer extends SerializableClosure implements CreatableInterface
{
    use Creatable;

    public function __construct(object $data)
    {
        Value::identity($data) |> parent::__construct(...);
    }

    public static function serialize(object $data): string
    {
        return static::create($data) |> Serializer\Native::serialize(...);
    }

    public static function unserialize(string $data): object
    {
        $data = Serializer\Native::unserialize($data);

        return $data instanceof static ? $data() : $data;
    }
}
