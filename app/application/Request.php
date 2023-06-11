<?php

declare(strict_types=1);

namespace app\application;

class Request
{
    public static function get(string $param): int|string|null
    {
        return $_GET[$param] ?? null;
    }

    public static function post(string $param): int|string|null
    {
        return $_POST[$param] ?? null;
    }

    public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getUri(): string
    {
        $fullUri = $_SERVER['REQUEST_URI'];

        return explode('?', $fullUri)[0];
    }
}