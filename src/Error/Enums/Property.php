<?php

namespace Mpietrucha\Utility\Error\Enums;

enum Property: string
{
    case TYPE = 'type';

    case MESSAGE = 'message';

    case FILE = 'file';

    case LINE = 'line';
}
