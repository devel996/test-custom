<?php

declare(strict_types=1);

namespace app\application;

use app\application\exceptions\BadRequestException;

trait CsrfTrait
{
    private function validateCsrf(): void
    {
        $csrf = Request::post('csrf_token');

        if ($csrf === null || !$csrf || !Csrf::validateToken($csrf)) {
            throw new BadRequestException('Invalid data');
        }
    }
}