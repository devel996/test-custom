<?php

declare(strict_types=1);

namespace app\application\exceptions;

use Exception;

class ConfigException extends Exception
{
    protected $code = 500;
}