<?php

namespace Mpietrucha\Utility\Type\Contracts;

interface TypeInterface
{
    public const string STRING = 'string';

    public const string INTEGER = 'int';

    public const string FLOAT = 'float';

    public const string BOOLEAN = 'bool';

    public const string ARRAY = 'array';

    public const string RESOURCE = 'resource (*)';

    public const string CLOSED_RESOURCE = 'resource (closed)';

    public const string ANONYMOUS_CLASS = 'class@anonymous';
}
