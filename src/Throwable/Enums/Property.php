<?php

namespace Mpietrucha\Utility\Throwable\Enums;

/**
 * Enum representing writable throwable properties for reflection-based mutation.
 */
enum Property: string
{
    case LINE = 'line';

    case FILE = 'file';

    case CODE = 'code';

    case TRACE = 'trace';

    case MESSAGE = 'message';

    case PREVIOUS = 'previous';
}
