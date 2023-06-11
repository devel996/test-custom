<?php

declare(strict_types=1);

namespace app\application\enums;

enum SenderType: string
{
    case EMAIL = 'email';
    case PHONE = 'phone';
}