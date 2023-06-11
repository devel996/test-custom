<?php

declare(strict_types=1);

namespace app\application\exceptions;

use Exception;

class BadRequestException extends Exception
{
    protected $code = 400;
}