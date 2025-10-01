<?php

namespace Mpietrucha\Utility\Error\Contracts;

interface InteractsWithLevelsInterface
{
    public const int ERROR = E_ERROR;

    public const int WARNING = E_WARNING;

    public const int PARSE = E_PARSE;

    public const int NOTICE = E_NOTICE;

    public const int CORE_ERROR = E_CORE_ERROR;

    public const int CORE_WARNING = E_CORE_WARNING;

    public const int COMPILE_ERROR = E_COMPILE_ERROR;

    public const int COMPILE_WARNING = E_COMPILE_WARNING;

    public const int DEPRECATED = E_DEPRECATED;

    public const int USER_ERROR = E_USER_ERROR;

    public const int USER_WARNING = E_USER_WARNING;

    public const int USER_NOTICE = E_USER_NOTICE;

    public const int USER_DEPRECATED = E_USER_DEPRECATED;

    public const int STRICT = E_STRICT;

    public const int  RECOVERABLE_ERROR = E_RECOVERABLE_ERROR;

    public const int  ALL = E_ALL;
}
