<?php

trait Supportable
{
    public static function supported(mixed ...$arguments): bool
    {
        $supported = Bridge::method(__METHOD__)->proxy()->supportable(...$arguments);

        return Normalizer::boolean($supported);
    }

    final public static function unsupported(mixed ...$arguments): bool
    {
        return Normalizer::not(self::supported(...$arguments));
    }

    protected static function supportable(): mixed
    {
        return false;
    }
}
