<?php

declare(strict_types=1);

namespace app\application;

class Env
{
    public static function get(string $name): ?string
    {
        if (isset($_ENV[$name])) {
            return (string)$_ENV[$name];
        }

        return null;
    }
}