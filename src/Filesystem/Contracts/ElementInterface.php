<?php

namespace Mpietrucha\Utility\Filesystem\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Contracts\StringableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, string>
 */
interface ElementInterface extends ArrayableInterface, StringableInterface
{
}
