<?php

declare(strict_types=1);

namespace app\application\routes;

use app\application\exceptions\NotFoundException;

class Router
{
    private static array $routes = [];

    public static function addRoute(RouteValueObject $route): void
    {
        self::$routes[$route->getKey()] = $route;
    }

    public static function get(string $method, string $route): RouteValueObject
    {
        if (isset(self::$routes[$route . '_' . $method])) {
            return self::$routes[$route . '_' . $method];
        }

        throw new NotFoundException('Invalid route');
    }

    public static function getAll(): array
    {
        return self::$routes;
    }
}