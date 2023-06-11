<?php

declare(strict_types=1);

namespace app\application\enums;

enum HttpMethod: string
{
    case POST = 'POST';
    case GET = 'GET';
    case DELETE = 'DELETE';
    case PUT = 'PUT';
    case PATCH = 'PATCH';
    case OPTIONS = 'OPTIONS';
    case HEAD = 'HEAD';
}