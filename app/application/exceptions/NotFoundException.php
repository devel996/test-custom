<?php

declare(strict_types=1);

namespace app\application\exceptions;

use Exception;

class NotFoundException extends Exception
{
    protected $code = 404;
}