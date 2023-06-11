<?php

declare(strict_types=1);

namespace app\application\enums;

enum HttpCode: int
{
    case OK = 200;
    case BAD_REQUEST = 400;
    case NOT_FOUND = 404;
    case SERVER_ERROR = 500;
}